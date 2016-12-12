<?php

namespace Glyf\Core\System;

class ScreenShot
{
	const PATH = '/upload/screenshot/';
	
	protected $url;
	protected $name;
    protected $path;
	
	
	public function __construct($url, $name)
	{
		$this->url  = (string) $url;
		$this->name = (string) $name;
        $this->path = static::PATH;
	}
	
	
	public function getURL()
	{
		return $this->url;
	}
	
	
	public function getName()
	{
		return $this->name;
	}

    
    public function getPath()
    {
        return $this->path;
    }
    
    
    /**
	 * Получение ссылки на файл.
	 */
	public function getFile($absolute = false)
	{
		$file = $this->getPath() . $this->getName() . '.pdf';
		
		if ($absolute) {
			$file = $_SERVER['DOCUMENT_ROOT'] . $file;
		}
		return $file;
	}
    
	
	/**
	 * Получение ссылки на файл.
	 */
	public function getLink($absolute = false)
	{
		$link = $this->getPath() . $this->getName() . '.pdf';
		
		if ($absolute) {
			$site = \CSite::GetByID(SITE_DEFAULT)->Fetch();
			$link = 'http://' . $site['SERVER_NAME'] . $link;
		}
		return $link;
	}
	
	
	/**
	 * Печать документа.
	 */
	public function make($delay = 0, $subargs = array())
	{	
		$url  = $this->getURL();
		$link = $this->getLink(true); 
        
        // TODO: mkdir ($this->getPath(), 0755, true); // рекурисвное создание директории.
		
		// Аргументы.
		$args = array('-q' => '', '--no-stop-slow-scripts' => ''); // , '--enable-javascript' => '', '--run-script' => '', '--load-error-handling' => 'ignore');
		
		$args = array_merge($args, $subargs);
		
		if ($delay > 0) {
			$args['--javascript-delay'] = $delay;
		}
		array_walk($args, function(&$val, $key) { $val = $key.' '.$val; });
		
		// Команда для выполнения.
		$cmd = 'wkhtmltopdf '.implode(' ', $args).' "'.$url.'" '.$_SERVER['DOCUMENT_ROOT'].$this->getLink();
		
		exec($cmd, $output, $result);
		
		return ($result === 0);
	}
	
}