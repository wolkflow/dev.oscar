<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

use Glyf\Oscar\Picture;

class Folder extends HLBlockModel
{
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
    
    
    /**
     * Событие на удаление.
     */
    protected function onDelete()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        
        $sql = "
            DELETE FROM `g_pictures`
            WHERE `" . Picture::FIELD_FOLDER . "` = '" . $this->getID() . "'
        ";
        
        $result = $connection->query($sql);
    }
}