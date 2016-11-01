<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

use Glyf\Oscar\User;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\Picture;


class LightboxPicture extends HLBlockModel
{
    const FIELD_LIGHTBOX = 'UF_LIGHTBOX';
    const FIELD_PICTURE  = 'UF_PICTURE';
    
    
	static protected $hlblockID = HLBLOCK_LIGHTBOXE_PICTURES_ID;
    
    
    public function getUserID()
    {
        $this->load();
        
        return $this->get(self::FIELD_USER);
    }
    
    
    public function getUser()
    {
        $this->load();
        
        return (new User($this->getUserID()));
    }
    
    
    public function getLightboxID()
    {
        $this->load();
        
        return $this->get(self::FIELD_LIGHTBOX);
    }
    
    
    public function getLightbox()
    {
        $this->load();
        
        return (new Lightbox($this->getUserID()));
    }
    
    
    public function getPictureID()
    {
        $this->load();
        
        return $this->get(self::FIELD_PICTURE);
    }
    
    
    public function getPicture()
    {
        $this->load();
        
        return (new Picture($this->getUserID()));
    }
}