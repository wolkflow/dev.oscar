<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

use Glyf\Oscar\LightboxPicture;
use Glyf\Oscar\Picture;

class Lightbox extends HLBlockModel
{
    const COUNT_LAST_PICTURES = 6;
    
    const FIELD_ID    = 'ID';
    const FIELD_TITLE = 'UF_TITLE';
    const FIELD_USER  = 'UF_USER';
    const FIELD_TIME  = 'UF_TIME';
    
	static protected $hlblockID = HLBLOCK_LIGHTBOXES_ID;
    
    
    
    public function getTitle()
    {
        $this->load();
        
        return $this->get(self::FIELD_TITLE);
    }
    
    
    public function getUserID()
    {
        $this->load();
        
        return $this->get(self::FIELD_USER);
    }
    
    
    public function getUser()
    {
        $this->load();
        
        return (new User($this->getUserID()));
    }
    
    
    public function getPictures($limit = null, $offset = null, $asobjects = true)
    {
        $connection = \Bitrix\Main\Application::getConnection();
        
        $sql = "
            SELECT *
            FROM `g_lightbox_pictures` AS `glp`
            INNER JOIN `g_pictures` AS `gp` ON (glp.UF_PICTURE = gp.ID)
            WHERE glp.UF_LIGHTBOX = '" . $this->getID() . "'
            ORDER BY glp.UF_TIME DESC
        ";
        
        if (!empty($limit)) {
            $sql .= " LIMIT " . intval($limit);
            
            if (!empty($offset) && $offset > 0) {
                $sql .= " OFFSET " . intval($offset);
            }
        }
        
        // Запрос.
        $result = $connection->query($sql);
        
        if (!$asobjects) {
            return $result;
        }
        
        $items  = array();
        while ($item = $result->fetch()) {
            if ($asobjects) {
                $items[$item['ID']] = new Picture($item['ID'], $item);
            } else {
                $items[$item['ID']] = $item;
            }
        }
        return $items;
    }
    
    
    /**
     * Количество картни в сборнике.
     */
    public function getPicturesCount()
    {
        $result = LightboxPicture::getList(array('filter' => array('UF_LIGHTBOX' => $this->getID())), false);
        
        return intval($result->getSelectedRowsCount());
    }
    
    
    /**
     * Последние добавленные изображения.
     */
    public function getLastPictures($asobjects = true)
    {
        return $this->getPictures(self::COUNT_LAST_PICTURES);
    }
    
    
    /**
     * Добавление каритны в сборник.
     */
    public function addPicture($pid)
    {
        $result = LightboxPicture::getList(array(
            'filter' => array(LightboxPicture::FIELD_LIGHTBOX => $this->getID(), LightboxPicture::FIELD_PICTURE => $pid), 
            'limit'  => 1
        ), false);
        
        if ($result->getSelectedRowsCount() > 0) {
            return true;
        }
        
        $lightpic = new LightboxPicture();
        $result   = $lightpic->add(array(
            'UF_LIGHTBOX' => $this->getID(),
            'UF_PICTURE'  => $pid,
            'UF_TIME'     => date('d.m.Y H:i:s')
        ));
        
        return $result;
    }
    
    
    
    public static function getUserLightboxes($uid, $params = array(), $objects = true)
    {
        $params['filter'] = array_merge((array) $params['filter'], array(self::FIELD_USER => intval($uid)));
        
        return self::getList($params, $objects);
    }
    
    
    
    /**
     * Событие на удаление.
     */
    protected function onDelete()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        
        $sql = "
            DELETE FROM `g_lightbox_pictures`
            WHERE `UF_LIGHTBOX` = '" . $this->getID() . "'
        ";
        
        $result = $connection->query($sql);
    }
}