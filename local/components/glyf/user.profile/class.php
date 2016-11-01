<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class UserProfileComponent extends \CBitrixComponent
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
        
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Данные пользователя.
        $this->arResult['USER'] = $user->getData();
        
        // Текущий баланс.
        $this->arResult['USER']['BALANCE'] = $user->getBalance();
        
        // Тариф.
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
