<?php

namespace Glyf\Oscar\Statistic;

use Glyf\Core\System\HLBlockModel;

class Download extends HLBlockModel
{
    const FIELD_ID         = 'ID';
    const FIELD_TIME       = 'UF_TIME';
    const FIELD_USER_ID    = 'UF_USER_ID';
    const FIELD_ELEMENT_ID = 'UF_ELEMENT_ID';
    
    static protected $hlblockID = HLBLOCK_STATISTIC_DOWNLOAD_ID;
    
    
    
    public function getTime()
    {
        return $this->get(self::FIELD_TIME);
    }
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getElementID()
    {
        return $this->get(self::FIELD_ELEMENT_ID);
    }
}