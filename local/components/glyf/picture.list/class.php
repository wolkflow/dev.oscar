<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class PicturesList extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Коллекция.
        $arParams['COLLECTION'] = (int) $arParams['COLLECTION'];
        
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
        
        if (empty($this->arParams['COLLECTION'])) {
            return;
        }
        
        $collection = new Collection($this->arParams['COLLECTION']);
        
        // Сортировка и фильтры.
        $order  = array(); // 'ID' => 'ASC');
        $filter = array(
            Picture::FIELD_MODERATE => true
        );
        
        // Элементы коллекции.
        $pictures = $collection->getPictures(array('order' => $order, 'filter' => $filter));
		
        $this->arResult['ITEMS'] = array();
        
        foreach ($pictures as $picture) {
            $item = $picture->getData();
            $item['COLLECTION'] = $picture->getCollection()->getData();
            $item['DETAIL_URL'] = $picture->getDetailURL();
            
            $this->arResult['ITEMS'][$picture->getID()] = $item;
        }
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
