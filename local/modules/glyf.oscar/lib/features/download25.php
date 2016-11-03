<?php

namespace Glyf\Oscar\Features;

class Download25 extends \Glyf\Oscar\Feature
{
    const CODE  = 'DOWNLOAD_25';
    const LIMIT = 25;
    
    
    public function __construct()
    {
        parent::__construct(self::CODE);
    }
}