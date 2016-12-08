<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class License extends HLBlockModel
{
    const FIELD_ID             = 'ID';
    const FIELD_LANG_TITLE_SFX = 'UF_LANG_TITLE_';
    const FIELD_LANG_TITLE_RU  = 'UF_LANG_TITLE_RU';
    const FIELD_LANG_TITLE_EN  = 'UF_LANG_TITLE_EN';
    const FIELD_STEP           = 'UF_STEP';
    const FIELD_ROOT           = 'UF_ROOT';
    const FIELD_PRICE          = 'UF_PRICE';
    
	static protected $hlblockID = HLBLOCK_LICENSES_ID;
    
    
    
    public function getTitle()
    {
        $this->load();
        
        return $this->get(self::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP);
    }
    
    
    public function getStep()
    {
        $this->load();
        
        return $this->get(self::FIELD_STEP);
    }
    
    
    public function getRoot()
    {
        $this->load();
        
        return $this->get(self::FIELD_ROOT);
    }
    
    
    public function getPrice()
    {
        $this->load();
        
        return $this->get(self::FIELD_PRICE);
    }
    
    
    public function getLicenseRoot()
    {
        $lid = $this->getRoot();
        
        while (!empty($lid)) {
            $license = new self($lid);
            $lid = $license->getRoot();
        }
        
        if (!empty($license)) {
            return $license;
        }
        return null;
    }
    
    public function getStepTitle()
    {
        // Свойства HL-блока.
        $cache = new \CPHPCache();
        $ctime = 86400;
        $ccode = 'properties';
        $cpath = '/properties/';
        if ($ctime > 0 && $cache->InitCache($ctime, $ccode, $cpath)) {
            $props = $cache->GetVars();
        } else {
            $props = \Glyf\Core\Helpers\HLBlock::getProps(self::$hlblockID, 'FIELD_NAME', 'ID');
            if ($cache->StartDataCache()) {
                $cache->EndDataCache($props);
            }
        }
        
        // Loc::getMessage();
        $title = $props[self::FIELD_STEP]['ENUMS'][$this->getStep()]['VALUE']; //['XML_ID'];
        
        return $title;
    }
}