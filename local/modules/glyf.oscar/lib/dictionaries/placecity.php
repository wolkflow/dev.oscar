<?php

namespace Glyf\Oscar\Dictionaries;

use Glyf\Core\System\HLBlockModel;

class PlaceCity extends HLBlockModel
{
	static protected $hlblockID = HLBLOCK_DICT_PLACE_CITIES_ID;
    
    
    public function getCountryID()
    {
        $this->load();
        
        return (int) $this->get('UF_COUNTRY');
    }
    
    
    public function getCountry()
    {
        $cid = $this->getCountryID();
        if ($cid <= 0) {
            return null;
        }
        return (new Glyf\Oscar\Dictionaries\PlaceCountry($cid));
    }
}