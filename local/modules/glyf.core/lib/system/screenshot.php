<?php

namespace Wolk\Core\System;

class ScreenShot
{
	const PATH   = '/upload/screenshot/';
	
	protected $url;
	protected $name;
	
	
	public function __construct($url, $name)
	{
		$this->url  = (string) $url;
		$this->name = (string) $name;
	}
	
	
	public function getURL()
	{
		return $this->url;
	}
	
	
	public function getName()
	{
		return $this->name;
	}

	
	/**
	 * Получение ссылки на файл.
	 */
	public function getLink($absolute = false)
	{
		$link = static::PATH . $this->getName() . '.pdf';
		
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