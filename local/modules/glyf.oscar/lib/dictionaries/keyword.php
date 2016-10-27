<?php

namespace Glyf\Oscar\Dictionaries;

use Glyf\Core\System\HLBlockModel;

class Keyword extends HLBlockModel
{
	static protected $hlblockID = HLBLOCK_DICT_KEYWORDS_ID;
    
    
    public function getName()
    {
        return $this->get('UF_LANG_NAME_' . CURRENT_LANG_UP);
    }
}