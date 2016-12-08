<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Subscribe;
use Glyf\Oscar\Search;

class MailSubscribeComponent extends \CBitrixComponent
{
    /** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {   
        // Идентификатор подписки.
        $arParams['SID'] = (int) $arParams['SID'];
        
        return $arParams;
	}
    
    
    /**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
			return;
		}
        
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
			return;
		}
        
        $this->arResult = array(
            'BLOGS'       => array(),
            'COLLECTIONS' => array(),
            'SEARCHES'    => array(),
        );
        
        // Подписка.
        $this->arResult['SUBSCRIBE'] = new Glyf\Oscar\Subscribe($this->arParams['SID']);
        
        // Получение статей блогов.
        $this->getBlogs();
        
        // Получение изображений по коллекциям.
        $this->getCollections();
        
        // Получение изображений по сохраненным поискам.
        $this->getSearches();
        
        
        
        // Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
    
    
    /**
     * Получение новыйх статей блога.
     */
    public function getBlogs()
    {
        $ids = $this->arResult['SUBSCRIBE']->getKindBlogs();
        
        if (empty($ids)) {
            return array();
        }
        
        $result = CIBlockSection::getList(
            array(), 
            array('IBLOCK_ID' => IBLOCK_BLOG_ID, 'ID' => $ids), 
            false, 
            array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'UF_LANG_TITLE_RU', 'UF_LANG_TITLE_EN')
        );
        
        $this->arResult['BLOGS']['SECTIONS'] = array();
        while ($element = $result->fetch()) {
            $this->arResult['BLOGS']['SECTIONS'][$element['ID']] = $element;
        }
        unset($element, $result);
        
        $result = CIBlockElement::getList(
            array('TIMESTAMP_X' => 'ASC'), 
            array('IBLOCK_ID' => IBLOCK_BLOG_ID, 'SECTION_ID' => $ids, 'ACTIVE' => 'Y', '>TIMESTAMP_X' => $this->arResult['SUBSCRIBE']->getLastTime()), 
            false,
            false,
            array('ID', 'IBLOCK_ID', 'SECTION_ID', 'NAME', 'CODE', 'PREVIEW_PICTURE', 'PROPERTY_LANG_TITLE_RU', 'PROPERTY_LANG_SUBTITLE_RU', 'DETAIL_PAGE_URL')
        );
        
        $this->arResult['BLOGS']['ITEMS'] = array();
        while ($element = $result->getNext()) {
            $element['PICTURE'] = CFile::getPath($element['PREVIEW_PICTURE']);
            
            $this->arResult['BLOGS']['ITEMS'][$element['ID']] = $element;
        }
        unset($element, $result);
    }
    
    
    /**
     * Получение новыйх ихображений в коллекциях.
     */
    public function getCollections()
    {
        $ids = $this->arResult['SUBSCRIBE']->getKindCollections();
        
        if (empty($ids)) {
            return array();
        }
        
        $result = CIBlockSection::getList(
            array(), 
            array('IBLOCK_ID' => IBLOCK_COLLECTIONS_ID, 'ID' => $ids), 
            false, 
            array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'UF_LANG_TITLE_RU', 'UF_LANG_TITLE_EN')
        );
        
        $this->arResult['COLLECTIONS']['SECTIONS'] = array();
        
        while ($section = $result->fetch()) {
            
            try {
                $filter = new \Glyf\Oscar\Filters\Picture();
            } catch (Exception $e) {
                continue;
            }
            
            // Коллекции.
            $filter->setCollections($section['ID']);
            
            // Время.
            $filter->setModerateTime($this->arResult['SUBSCRIBE']->getLastTime());
            
            // Модерация.
            $filter->setModerate(true);
            
            // Фильтрация.
            $filter->execute();
            
            // Результаты фильтрации.
            $res = $filter->getResult();
            
            while ($item = $res->fetch()) {
                $section['ITEMS'] []= $item;
            }
            unset($res, $item);
            
            if (empty($section['ITEMS'])) {
                continue;
            }
            $this->arResult['COLLECTIONS']['ITEMS'][$section['ID']] = $section;
        }
        unset($section, $result);
    }
    
    
    /**
     * Получение новыйх ихображений в поиске.
     */
    public function getSearches()
    {
        $ids = $this->arResult['SUBSCRIBE']->getKindSearches();
        
        if (empty($ids)) {
            return array();
        }
        
        $searches = Search::getList(array(
            'filter' => array(Search::FIELD_ID => $ids)
        ));
        
        $this->arResult['SEARCHES']['SEARCHES'] = array();
        foreach ($searches as $search) {
            // Поиск.
            $element = array(
                'TITLE' => $search->getTitle(),
                'LINK'  => $search->getLink(),
            );
            
            $filter = $search->getFilter();
            $filter['>' . Picture::FIELD_MODERATE_TIME] = $this->arResult['SUBSCRIBE']->getLastTime();
            
            $result = Picture::getList(array(
                'filter' => $filter
            ), false);
            
             $element['ITEMS'] = array();
            while ($item = $result->fetch()) {
                 $element['ITEMS'] []= $item;
            }
            
            if (empty($element['ITEMS'])) {
                continue;
            }
            
            $this->arResult['SEARCHES']['ITEMS'] []= $element;
        }
    }
}









