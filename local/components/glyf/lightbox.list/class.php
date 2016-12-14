<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\LightboxPicture;

class LightboxListComponent extends \CBitrixComponent
{
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {   
        // Лимит отображения.
        $arParams['LIMIT'] = (int) $arParams['LIMIT'];
    
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
        $this->arResult['USER'] = new Glyf\Oscar\User();
        
        // Справочники.
        if ($this->arParams['LIMIT'] > 0) {
            $lightboxes = $this->arResult['USER']->getLightboxes(array('limit' => $this->arParams['LIMIT']));
        } else {
            $lightboxes = $this->arResult['USER']->getLightboxes();
        }
        
        
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
        
        $this->arResult['LIGHTBOXES_COUNT'] = $this->arResult['USER']->getLightboxesCount();
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
