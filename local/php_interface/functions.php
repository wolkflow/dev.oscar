<?php


// Функция подключения языкового файла для включаемой области.
if (!function_exists('IncludeAreaLangFile')) {
	function IncludeAreaLangFile($file)
	{
		$basepath = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH;
		$langfile = $basepath  . '/lang/' . CURRENT_LANG . str_replace($basepath, '' , $file);
		
		__IncludeLang($langfile);
	}
}

// Функция подключения языкового файла для шаблона с одним сайтом.
if (!function_exists('IncludeComponentTemplateLangFile')) {
	function IncludeComponentTemplateLangFile($file, $template)
	{
		$basepath = $_SERVER['DOCUMENT_ROOT'] . $template;
		$filename = str_replace($basepath, '', $file);
		$langfile = $basepath  . '/lang/' . CURRENT_LANG . $filename;
		
		__IncludeLang($langfile);
	}
}

// Функция подключения языкового файла для страницы.
if (!function_exists('IncludeFileLangFile')) {
	function IncludeFileLangFile($file)
	{
		$basepath = $_SERVER['DOCUMENT_ROOT'];
		$langfile = $basepath  . '/local/lang/' . CURRENT_LANG . str_replace($basepath, '' , $file);
		
		__IncludeLang($langfile);
	}
}