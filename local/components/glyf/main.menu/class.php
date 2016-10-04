<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class MainMenuComponent extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
	}
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
		global $USER;
		
		Loader::includeModule('glyf.core');
		
		$this->arResult = array(
			'COUNT_COLLECTIONS' => 30,
			'COUNT_OBJECTS'     => 345000,
			'COUNT_SUBSCRIBES'  => 10,
			'COUNT_ARTICLES'    => 195,
		);
		
		$this->includeComponentTemplate();
	}
}