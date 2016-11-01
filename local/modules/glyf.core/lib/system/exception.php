<?php

namespace Glyf\Core\System;


class Exception extends \Exception
{
    protected $key = '';
    
    
    public function __construct($message = '', $code = 0, \Throwable $previous = null, $key = '')
    {
        $this->key = (string) $key;
        
        parent::__construct($message, $code, $previous);
    }
}