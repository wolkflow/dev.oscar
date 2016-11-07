<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class IPAddress extends HLBlockModel
{
    const FIELD_USER_ID = 'UF_USER_ID';
    const FIELD_IP      = 'UF_IP';
    const FIELD_TIME    = 'UF_TIME';
    
	static protected $hlblockID = HLBLOCK_IPADDRESSES_ID;
    
    
    
    public function getUserID()
    {
        $this->load();
        
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getUser()
    {
        $this->load();
        
        return (new User($this->getUserID()));
    }
    
    
    public function getIP()
    {
        $this->load();
        
        return $this->get(self::FIELD_IP)
    }
    
    
    public function getTime()
    {
        $this->load();
        
        return $this->get(self::FIELD_TIME)
    }
    
    
    public static function getUserIPs($uid, $filters = array(), $objects = true)
    {
        $filter = array_merge((array) $filters, array(self::FIELD_USER_ID => intval($uid)));
        
        return self::getList(array('filter' => $filter), $objects);
    }
}