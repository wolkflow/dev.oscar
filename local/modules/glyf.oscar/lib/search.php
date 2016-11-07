<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class Search extends HLBlockModel
{
    const FIELD_ID     = 'ID';
    const FIELD_TIME   = 'UF_TIME';
    const FIELD_USER   = 'UF_USER';
    const FIELD_TITLE  = 'UF_TITLE';
    const FIELD_FIELDS = 'UF_FIELDS';
    
    const FILTERS_CODE = 'F';
    
    static protected $hlblockID = HLBLOCK_SEARCHES_ID;
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER);
    }
    
    
    public function getTitle()
    {
        return $this->get(self::FIELD_TITLE);
    }
    
    
    public function getSourceFields()
    {
        return $this->get(self::FIELD_FIELDS);
    }
    
    
    public function getFields()
    {
        return array(self::FILTERS_CODE => json_decode($this->get(self::FIELD_FIELDS), true));
    }
}