<?php

namespace Glyf\Oscar\System;

class ScreenPDF extends \Glyf\Core\System\ScreenShot
{
    const PATH = '/upload/pdf/';
    
    
    public function setExPath($path)
    {
        $this->path = self::PATH . ltrim('/', $path);
    }
       
}