<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

use Glyf\Oscar\Picture;

class Folder extends HLBlockModel
{
    const FIELD_ID    = 'ID';
    const FIELD_TITLE = 'UF_TITLE';
    const FIELD_USER  = 'UF_USER';
    const FIELD_TIME  = 'UF_TIME';
    
	static protected $hlblockID = HLBLOCK_DICT_FOLDERS_ID;
    
    
    
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
    
    
    public function getPreviewPicture()
    {
        $picture = reset(Picture::getList(array(
            'order'  => array(Picture::FIELD_ID => 'ASC'), 
            'filter' => array(Picture::FIELD_FOLDER => $this->getID()), 
            'limit'  => 1
        )));
        
        return $picture;
    }
    
    
    public static function getUserFolders($uid, $filters = array(), $objects = true)
    {
        $filter = array_merge((array) $filters, array(self::FIELD_USER => intval($uid)));
        
        return self::getList(array('filter' => $filter), $objects);
    }
    
    
    public function getPictures($limit = null, $offset = null, $asobjects = true)
    { 
        $connection = \Bitrix\Main\Application::getConnection();
        
        $sql = "
            SELECT *
            FROM `g_folders` AS `f`
            INNER JOIN `g_pictures` AS `p` ON (p.UF_FOLDER = f.ID)
            WHERE p.UF_FOLDER = '" . $this->getID() . "'
            ORDER BY p.UF_TIME DESC
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
     * Событие на удаление.
     */
    protected function onDelete()
    {
        $pictures = Picture::getList(array(
            'filter' => array(Picture::FIELD_FOLDER => $this->getID())
        ));
        
        if (!empty($pictures)) {
            foreach ($pictures as $picture) {
                $picture->delete();
            }
        }
        /*
        $connection = \Bitrix\Main\Application::getConnection();
        
        $sql = "
            DELETE FROM `g_pictures`
            WHERE `" . Picture::FIELD_FOLDER . "` = '" . $this->getID() . "'
        ";
        */
        // $result = $connection->query($sql);
    }
}