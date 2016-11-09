<?php

namespace Glyf\Oscar\Statistic;

use Glyf\Core\System\HLBlockModel;
use Glyf\Oscar\License;
use Glyf\Oscar\Picture;

class Sale extends HLBlockModel
{
    const FIELD_ID          = 'ID';
    const FIELD_TIME        = 'UF_TIME';
    const FIELD_USER_ID     = 'UF_USER_ID';
    const FIELD_UPLOADER_ID = 'UF_UPLOADER_ID';
    const FIELD_ELEMENT_ID  = 'UF_ELEMENT_ID';
    const FIELD_LICENSE     = 'UF_LICENSE';
    const FIELD_LICENSE_ID  = 'UF_LICENSE_ID';
    const FIELD_PRICE       = 'UF_PRICE';
    const FIELD_ORDER_ID    = 'UF_ORDER_ID';
    
    static protected $hlblockID = HLBLOCK_STATISTIC_SALES_ID;
    
    
    
    public function getTime()
    {
        return $this->get(self::FIELD_TIME);
    }
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getUploaderID()
    {
        return $this->get(self::FIELD_UPLOADER_ID);
    }
    
    
    public function getElementID()
    {
        return $this->get(self::FIELD_ELEMENT_ID);
    }
    
    
    /*
    public function getLicense()
    {
        return $this->get(self::FIELD_LICENSE);
    }
    */
    
    public function getLicenseID()
    {
        return $this->get(self::FIELD_LICENSE_ID);
    }
    
    
    public function getPrice()
    {
        return $this->get(self::FIELD_PRICE);
    }
    
    
    public function getOrderID()
    {
        return $this->get(self::FIELD_ORDER_ID);
    }
    
    
    
    public function getPicture()
    {
        return (new Picture($this->getElementID()));
    }
    
    public function getLicense()
    {
        return (new License($this->getLicenseID()));
    }
    
}