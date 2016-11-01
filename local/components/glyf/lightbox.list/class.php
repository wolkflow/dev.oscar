<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\LightboxPicture;

class LightboxList extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {   
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
        
        $this->arResult = array();
        
       
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Справочники.
        $lightboxes = $user->getLightboxes();
        
        $this->arResult['LIGHTBOXES'] = array();
        foreach ($lightboxes as $lightbox) {
            // Данные.
            $data = $lightbox->getData();
            
            // Последние картины.
            $data['PICTURES'] = $lightbox->getLastPictures(false);
            
            // Общее количество картин в сборнике.
            $data['COUNT'] = $lightbox->getPicturesCount();
            
            
            $this->arResult['LIGHTBOXES'][$lightbox->getID()] = $data;
        }
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
