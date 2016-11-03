<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

use Glyf\Oscar\LightboxPicture;
use Glyf\Oscar\Picture;

class Lightbox extends HLBlockModel
{
    const COUNT_LAST_PICTURES = 6;
    
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
    
    
    public function getPictures($limit = null, $asobjects = true)
    {
        //$lbpictures = LightboxPicture::getList(array('filter' => array('UF_LIGHTBOX' => $this->getID())));
        //$pictures   = LightboxPicture::getList(array('filter' => array('ID' => array_keys($lbpictures))));
        
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
        }
        
        $result = $connection->query($sql);
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
        $lightpic = new LightboxPicture();
        $result   = $lightpic->add(array(
            'UF_LIGHTBOX' => $this->getID(),
            'UF_PICTURE'  => $pid,
            'UF_TIME'     => date('d.m.Y H:i:s')
        ));
        
        return $result->isSuccess();
    }
    
    
    public static function getUserLightboxes($uid, $filters = array(), $objects = true)
    {
        $filter = array_merge((array) $filters, array(self::FIELD_USER => intval($uid)));
        
        return self::getList(array('filter' => $filter), $objects);
    }
}