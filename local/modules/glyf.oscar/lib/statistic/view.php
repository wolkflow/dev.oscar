<?php

namespace Glyf\Oscar\Statistic;

use Glyf\Core\System\HLBlockModel;

class View extends HLBlockModel
{
    const FIELD_ID         = 'ID';
    const FIELD_TIME       = 'UF_TIME';
    const FIELD_TYPE       = 'UF_TYPE';
    const FIELD_IP         = 'UF_IP';
    const FIELD_USER_ID    = 'UF_USER_ID';
    const FIELD_ELEMENT_ID = 'UF_ELEMENT_ID';
    
    static protected $hlblockID = HLBLOCK_STATISTIC_VIEW_ID;
    
    
    
    public function getTime()
    {
        return $this->get(self::FIELD_TIME);
    }
    
    
    public function getType()
    {
        return $this->get(self::FIELD_TYPE);
    }
    
    
    public function geIP()
    {
        return $this->get(self::FIELD_IP);
    }
    
    
    public function geUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function geElementID()
    {
        return $this->get(self::FIELD_ELEMENT_ID);
    }
}