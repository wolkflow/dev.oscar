<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Core\Helpers\HLBlock as HLBlockHelper;
use Glyf\Core\Helpers\IBlock as IBlockHelper;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class FilterPictures extends \CBitrixComponent
{
    protected $filter = array();
    
    
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
        
        // Данные для фильтрации.
		$this->arResult['DATA'] = array();
		
        // Фильтры.
        $this->arResult['FILTERS'] = $this->getFilter();
		
        // Сохранение данных
        if (!empty($_REQUEST) && isset($_REQUEST['F'])) {
			foreach ($_REQUEST['F'] as $key => $value) {
				$this->arResult['DATA'][$key] = (is_array($value)) ? (array_map('strval', (array) $value)) : ((string) $value);
			}
		}
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
    
    
    /**
     * Получение фильтра.
     */
    protected function getFilter()
    {
        if (empty($this->filter)) {
            $this->make();
        }
        return $this->filter;
    }
    
    
    /**
     * Создание фильтров.
     */
    protected function make()
    {
        // Свойства HL-блока.
        $props = HLBlockHelper::getProps(HLBLOCK_PICTURES_ID, 'FIELD_NAME', 'ID');
        
        
        
        // Тип объекта (коллекции).
        $this->filter['COLLECTION'] = array();
        $collections = Collection::getList(array('filter' => array('ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1)));
        foreach ($collections as $collection) {
            $this->filter['COLLECTION'][$collection->getID()] = $collection->getTitle();
        }
        
        
        // Техника.
        $this->filter['TECHNIQUE'] = array();
        foreach ($props[Picture::FIELD_TECHNIQUE]['ENUMS'] as $enum) {
            $this->filter['TECHNIQUE'][$enum['ID']] = $enum['XML_ID'];
        }
        
        
        // Жанр.
        $this->filter['GENRE'] = array();
        foreach ($props[Picture::FIELD_GENRE]['ENUMS'] as $enum) {
            $this->filter['GENRE'][$enum['ID']] = $enum['XML_ID'];
        }
        
        
        // Цвет.
        $this->filter['COLOR'] = array();
        foreach ($props[Picture::FIELD_COLOR]['ENUMS'] as $enum) {
            $this->filter['COLOR'][$enum['ID']] = $enum['XML_ID'];
        }
        
        
        // Правовой режим.
        $this->filter['LEGAL'] = array();
        foreach ($props[Picture::FIELD_LEGAL]['ENUMS'] as $enum) {
            $this->filter['LEGAL'][$enum['ID']] = $enum['XML_ID'];
        }
        
       //  print_r($this->filter);
    }
	
}










