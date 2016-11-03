<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Partner;
use Glyf\Oscar\User;

class StatisticCommonComponent extends \CBitrixComponent
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
        
        if (empty($this->arParams['PID'])) {
            return;
        }
        
        // Пользователь.
        $partner = new Partner();
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
