<?php

namespace Glyf\Oscar\Dictionaries;

use Glyf\Core\System\HLBlockModel;

class Author extends HLBlockModel
{
	static protected $hlblockID = HLBLOCK_DICT_AUTHORS_ID;
    
    
    public function getName()
    {
        return $this->get('UF_LANG_NAME_' . CURRENT_LANG_UP);
    }
}