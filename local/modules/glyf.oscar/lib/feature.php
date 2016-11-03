<?php

namespace Glyf\Oscar;

class Feature
{
    protected $code;
    protected $title;
    
    
    public function __construct($code)
    {
        $this->code = (string) $code;
    }
    
    public function getCode()
    {
        return $this->code;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
}