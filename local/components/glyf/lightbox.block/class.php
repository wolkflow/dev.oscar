<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\LightboxPicture;

class LightboxBlockComponent extends \CBitrixComponent
{
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {   
        // Идентификатор.
        $arParams['LID'] = (int) $arParams['LID'];
    
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
        
        if (empty($this->arParams['LID'])) {
            return;
        }
        
        $this->arResult = array();
        
       
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Справочник.
        $lightbox = new Lightbox($this->arParams['LID']);
        
        
        // Данные.
        $this->arResult['LIGHTBOX'] = $lightbox->getData();
        
        // Последние картины.
        $this->arResult['PICTURES'] = $lightbox->getLastPictures(false);
        
        // Общее количество картин в сборнике.
        $this->arResult['COUNT'] = $lightbox->getPicturesCount();
        
        // Данные.
        $this->arResult['LIGHTBOX'] = $lightbox->getData();
        
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
