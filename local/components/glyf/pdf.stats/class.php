<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class PDFStatsComponent extends \CBitrixComponent
{   
    const PREFIX_TABLE_VIEWS    = 'v.';
    const PREFIX_TABLE_SALES    = 's.';
    const PREFIX_TABLE_PICTURES = 'p.';
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ID пользователя.
        $arParams['UID'] = (int) $arParams['UID'];
        
        // Количество на странице.
        $arParams['IDS'] = (array) $arParams['IDS'];
        
        // Период от.
        $arParams['PERIOD_MIN'] = (string) $arParams['PERIOD_MIN'];
        
        // Период после.
        $arParams['PERIOD_MAX'] = (string) $arParams['PERIOD_MAX'];
        
        
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
        
        if (empty($this->arParams['UID'])) {
            return;
        }
        
        // Пользователь.
        $this->arResult['USER'] = new Glyf\Oscar\User($this->arParams['UID']);
        
        
        $this->arParams['IDS'] = array_filter(array_map('intval', $this->arParams['IDS']));
        
        $filter[self::PREFIX_TABLE_PICTURES . Picture::FIELD_ID] = $this->arParams['IDS'];
        
        if (!empty($this->arParams['PERIOD_MIN'])) {
            $filter['>=' . self::PREFIX_TABLE_VIEWS . View::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MIN']));
            $filter['>=' . self::PREFIX_TABLE_SALES . Sale::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MIN']));
        }
        
        if (!empty($this->arParams['PERIOD_MAX'])) {
            $filter['<=' . self::PREFIX_TABLE_VIEWS . View::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MAX']));
            $filter['<=' . self::PREFIX_TABLE_SALES . Sale::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MAX']));
        }
        
        
        // Список элементов папки.
        $this->arResult['ITEMS'] = Picture::getStats(array('filter' => $filter));
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
