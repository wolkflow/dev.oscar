<?php

namespace Glyf\Oscar\Dictionaries;

use Glyf\Core\System\HLBlockModel;

class Holder extends HLBlockModel
{
	static protected $hlblockID = HLBLOCK_DICT_HOLDERS_ID;
    
    
    public function getName()
    {
        return $this->get('UF_LANG_NAME_' . CURRENT_LANG_UP);
    }
    
    
    public function getCode()
    {
        return $this->get('UF_CODE');
    }
}