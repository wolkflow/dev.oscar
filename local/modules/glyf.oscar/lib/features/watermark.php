<?php`<?php

namespace Glyf\Oscar\Features;

class Watermark extends \Glyf\Oscar\Feature
{
    const CODE = 'WATERMARK';
    
    
    public function __construct()
    {
        parent::__construct(self::CODE);
    }
}