<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Picture;

class MailSubscribeComponent extends \CBitrixComponent
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
        
        $this->arResult = array(
            'BLOHS'    => array(),
            'PICTURES' => array(),
            'SEARCHES' => array(),
        );
        
        // Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
    
    
    /**
     * Получение новыйх статей блога.
     */
    public function getBlogs()
    {
        
    }
    
    
    /**
     * Получение новыйх ихображений в коллекциях.
     */
    public function getPictures()
    {
        
    }
    
    
    /**
     * Получение новыйх ихображений в поиске.
     */
    public function getSearches()
    {
        
    }
}