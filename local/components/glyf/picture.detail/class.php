<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class PicturesDetail extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Идентификатор.
        $arParams['PID'] = (int) $arParams['PID'];
        
        return $arParams;
	}
	
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
			return;
		}
        
        if (empty($this->arParams['PID'])) {
            return;
        }
        
        // Картина.
        $picture = new Picture($this->arParams['PID']);
        
        // Коллекция.
        $collection = $picture->getCollection();
        
        $this->arResult['PICTURE']    = $picture->getData();
        $this->arResult['COLLECTION'] = $collection->getData();
        $this->arResult['NAVIGATION'] = $collection->getChains();
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
