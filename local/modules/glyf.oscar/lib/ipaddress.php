<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class IPAddress extends HLBlockModel
{
    const FIELD_USER_ID = 'UF_USER_ID';
    const FIELD_IP      = 'UF_IP';
    const FIELD_IPS     = 'UF_IPS';
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
        
        return $this->get(self::FIELD_IP);
    }
    
    
    public function getIPs()
    {
        $this->load();
        
        return $this->get(self::FIELD_IPS);
    }
    
    
    public function getTime()
    {
        $this->load();
        
        return $this->get(self::FIELD_TIME);
    }
    
    
    public static function check($uid, $value)
    {
        $result = self::getList(array(
            'filter' => array('!'.self::FIELD_USER_ID => intval($uid), self::FIELD_IPS => strval($value)), 
            'limit' => 1
        ), false);
        
        if ($result->getSelectedRowsCount() > 0) {
            return false;
        }
        return true;
    }
}