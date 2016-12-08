<?php

namespace Glyf\Oscar\Statistic;

use Glyf\Core\System\HLBlockModel;
use Glyf\Oscar\License;
use Glyf\Oscar\Picture;

class Sale extends HLBlockModel
{
    const FIELD_ID           = 'ID';
    const FIELD_TIME         = 'UF_TIME';
    const FIELD_USER_ID      = 'UF_USER_ID';
    const FIELD_UPLOADER_ID  = 'UF_UPLOADER_ID';
    const FIELD_ELEMENT_ID   = 'UF_ELEMENT_ID';
    const FIELD_LICENSE      = 'UF_LICENSE';
    const FIELD_LICENSE_ID   = 'UF_LICENSE_ID';
    const FIELD_LICENSE_ROOT = 'UF_LICENSE_ROOT';
    const FIELD_PRICE        = 'UF_PRICE';
    const FIELD_ORDER_ID     = 'UF_ORDER_ID';
    
    static protected $hlblockID = HLBLOCK_STATISTIC_SALES_ID;
    
    
    
    public function getTime()
    {
        return $this->get(self::FIELD_TIME);
    }
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getUploaderID()
    {
        return $this->get(self::FIELD_UPLOADER_ID);
    }
    
    
    public function getElementID()
    {
        return $this->get(self::FIELD_ELEMENT_ID);
    }
    
    
    /*
    public function getLicense()
    {
        return $this->get(self::FIELD_LICENSE);
    }
    */
    
    public function getLicenseID()
    {
        return $this->get(self::FIELD_LICENSE_ID);
    }
    
    public function getLicenseRootID()
    {
        return $this->get(self::FIELD_LICENSE_ROOT);
    }
    
    public function getPrice()
    {
        return $this->get(self::FIELD_PRICE);
    }
    
    
    public function getOrderID()
    {
        return $this->get(self::FIELD_ORDER_ID);
    }
    
    
    public function getPicture()
    {
        return (new Picture($this->getElementID()));
    }
    
    
    public function getLicense()
    {
        return (new License($this->getLicenseID()));
    }
    
    
    public function getLicenseRoot()
    {
        return (new License($this->getLicenseRootID()));
    }
    
    
    /**
     * Получение списка продаж.
     */
    public static function getSalesList($params = array(), $asobjects = true)
    {
        $connection = \Bitrix\Main\Application::getConnection();
        
        // Запрос.
        $sql = "
            SELECT s.*
            FROM `g_statistic_sales` AS `s`
            INNER JOIN `g_pictures` AS `p` ON (s.UF_ELEMENT_ID = p.ID)
        ";
        
        if (!empty($params['filter'])) {
            $wheres = array();
            foreach ($params['filter'] as $key => $val) {
                $op = substr($key, 0, 2);
                
                switch ($op) {
                    case ('<='):
                    case ('>='):
                        $key = substr($key, 2);
                        break;
                    
                    case ('~='):
                        $op  = 'LIKE';
                        $key = substr($key, 2);
                        break;
                    
                    default:
                        $op = '=';
                        break;
                }
                
                if (is_array($val)) {
                    $wheres []= $key . " IN ('" . implode("', '", $val) . "')";
                } else {
                    $wheres []= $key . " " . $op . " '" . $val . "'";
                }
            }
            $sql .= " WHERE " . implode(' AND ', $wheres);
        }
                
        if (!empty($params['order'])) {
            $orders = array();
            foreach ($params['order'] as $key => $val) {
                $orders []= $key . " " . $val;
            }
            $sql .= " ORDER BY " . implode(', ', $orders);
        }
        
        if (!empty($params['limit'])) {
            $sql .= " LIMIT " . intval($params['limit']);
            
            if (!empty($params['offset']) && $params['offset'] > 0) {
                $sql .= " OFFSET " . intval($params['offset']);
            }
        }
        
        // Запрос.
        $result = $connection->query($sql);
        
        if (!$asobjects) {
            return $result;
        }
        
        $items = array();
        while ($item = $result->fetch()) {
            $items[$item['ID']] = new self($item['ID'], $item);
        }
        return $items;
    }
}


