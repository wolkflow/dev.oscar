<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class PDFOrdersComponent extends \CBitrixComponent
{   
    const PREFIX_TABLE_SALES    = 's.';
    const PREFIX_TABLE_PICTURES = 'p.';
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ID пользователя.
        $arParams['UID'] = (int) $arParams['UID'];
        
        // ID заказов (продаж).
        $arParams['IDS'] = (array) $arParams['IDS'];
        
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
        
        
        // Список элементов.
        $sales = Sale::getList(array(
            'filter' => array(Sale::FIELD_USER_ID => $this->arResult['USER']->getID(), Sale::FIELD_ID => $this->arParams['IDS'])
        ));
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        foreach ($sales as $sale) {
            $item = $sale->getData();
            
            $item['PICTURE'] = $sale->getPicture()->getData();
            $item['LICENSE'] = $sale->getLicenseRoot()->getData();
            
            $this->arResult['ITEMS'] []= $item;
        }
        unset($item);
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
