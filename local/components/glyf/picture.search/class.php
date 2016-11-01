<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class PictureSearchComponent extends \CBitrixComponent
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
        
        // Запрос.
        $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        
        // Фильтры.
        $filters = $request->get('F');
        
        // Сортировка и фильтры.
        $sort = array('ID' => 'ASC');
        
        
        try {
            $filter = new Glyf\Oscar\Filters\Picture();
        } catch (Exception $e) {
            return;
        }
        
        
        // Создание фильтра.
        $this->makeFilters($filter, $filters);
        
        // Задание сортировки.
        //$filter->setOrder($this->arParams['ORDER']);
        
        // Задани фильтра.
        // $filter->setFilter(array_merge($filter->getFilter(), $this->arParams['FILTER']));
        
        // Задание параметров навигации.
        // $filter->setNav($this->arParams['NAV']);
        
        echo '<pre>';
        print_r($filter->getFilter());
        echo '</pre>';
        return;
        
        // Фильтрация.
        $filter->execute();
        
        // Получение результата фильтрации.
        $result = $filter->getResult();
        
        // Элементы коллекции.
        $pictures = $collection->getPictures(array('sort' => $sort, 'filter' => $filter));
		
        $this->arResult['ITEMS'] = array();
        
        foreach ($pictures as $picture) {
            $item = $picture->getData();
            $item['COLLECTION'] = $picture->getCollection()->getData();
            $item['DETAIL_URL'] = $picture->getDetailURL();
            
            $this->arResult['ITEMS'][$picture->getID()] = $item;
        }
        
        
        // Постраничная навигация.
        $this->arResult['NAV_STRING'] = $result->GetPageNavStringEx($nav, 'ЖК', 'estates', false, $this);
        
        // Общее количество.
        $this->arResult['COUNT'] = $result->SelectedRowsCount();	
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
    
    /**
     * Создание фильтра.
     */
    protected function makeFilters(&$filter, $filters = array())
    {
        $filters = (array) $filters;
        
        // Название.
		if (!empty($filters['TITLE'])) {
			$filter->setTitle($filters['TITLE']);
		}
        
        // Автор.
		if (!empty($filters['AUTHOR'])) {
			$filter->setAuthor($filters['AUTHOR']);
		}
        
        // Правообладатель.
		if (!empty($filters['HOLDER'])) {
			$filter->setHolder($filters['HOLDER']);
		}
        
        // Период.
		if (!empty($filters['PERIOD_FROM']) || !empty($filters['PERIOD_TO'])) {
			$filter->setPeriod($filters['PERIOD_FROM'], $filters['PERIOD_TO'], $filters['PERIOD_FROM_ERA'], $filters['PERIOD_TO_ERA'], $filters['ISYEAR']);
		}
        
        // Техника.
		if (!empty($filters['TECHNIQUE'])) {
			$filter->setTechnique($filters['TECHNIQUE']);
		}
        
        // ID.
		if (!empty($filters['ID'])) {
			$filter->setIDs($filters['ID']);
		}
        
        // Ключевые слова.
		if (!empty($filters['KEYWORDS'])) {
			$filter->setKeywords(explode(',', $filters['KEYWORDS']));
		}
        
        // Коллекции.
		if (!empty($filters['COLLECTION'])) {
			$filter->setCollections($filters['COLLECTION']);
		}
        
        // Жанр.
		if (!empty($filters['GENRE'])) {
			$filter->setGenre($filters['GENRE']);
		}
        
        // Местоположение.
		if (!empty($filters['COUNTRY'])) {
			$filter->setPlace($filters['COUNTRY'], $filters['CITY']);
		}
        
        // Размеры.
		if (!empty($filters['SIZEMIN']) || !empty($filters['SIZEMAX'])) {
			$filter->setSize($filters['SIZEMIN'], $filters['SIZEMAX']);
		}
        
        // Цвет.
		if (!empty($filters['COLOR'])) {
			$filter->setColor($filters['COLOR']);
		}
        
        // Правовой режим.
		if (!empty($filters['LEGAL'])) {
			$filter->setLegal($filters['LEGAL']);
		}
        
        // Модерация.
        $filter->setModerate(true);
    }
}
