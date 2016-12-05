<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class StatisticObjectsDetail extends \CBitrixComponent
{
    const PERPAGE = 30;
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Количество на странице.
        $arParams['PERPAGE'] = (int) $arParams['PERPAGE'];
        
        if (!in_array($arParams['PERPAGE'], array(30, 60, 90))) {
           $arParams['PERPAGE'] = self::PERPAGE;
        }
        
        // Страница.
        $arParams['PAGE'] = (int) $arParams['PAGE'];
        
        if ($arParams['PAGE'] <= 0) {
            $arParams['PAGE'] = 1;
        }
        
        // Поиск по наванию.
        $arParams['TITLE'] = (string) $arParams['TITLE'];
        
         // Период от.
        $arParams['PERIOD_MIN'] = (string) $arParams['PERIOD_MIN'];
        
        // Период после.
        $arParams['PERIOD_MAX'] = (string) $arParams['PERIOD_MAX'];
        
        // Сортировка.
        $arParams['ORDER'] = (string) $arParams['ORDER'];
        
        switch ($arParams['ORDER']) {
            case ('ID'):
                $arParams['ORDER'] = array(Picture::FIELD_ORDER_ID => 'DESC');
                break;
            
             case ('title'):
                $arParams['ORDER'] = array(Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP => 'ASC');
                break;
            
            case ('views'):
                $arParams['ORDER'] = array(Picture::FIELD_VIEWS => 'DESC');
                break;
            
            case ('sales'):
                $arParams['ORDER'] = array(Picture::FIELD_SALES => 'DESC');
                break;
            
            default:
                $arParams['ORDER'] = array(Picture::FIELD_ID => 'DESC');
                break;
        }
        
        
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
        $user = new User();
        
        
        // Фильтр.
        $filter = array(Picture::FIELD_USER_ID => $user->getID());
        
        if (!empty($this->arParams['TITLE'])) {
            $filter[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] = '%'.$this->arParams['TITLE'].'%';
        }
        
        if (!empty($this->arParams['PERIOD_MIN'])) {
            $filter['>=' . Picture::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MIN']));
        }
        
        if (!empty($this->arParams['PERIOD_MAX'])) {
            $filter['<=' . Picture::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MAX']));
        }
        
        
        // Общее количество.
        $result = Picture::getList(array(
            'filter' =>  $filter
        ), false);
        
        $this->arResult['TOTAL'] = $result->getSelectedRowsCount();
        
        // Количество страниц.
        $pagescnt = ceil($this->arResult['TOTAL'] / $this->arParams['PERPAGE']);
        
        if ($this->arParams['PAGE'] > $pagescnt) {
            $this->arParams['PAGE'] = $pagescnt;
        }
        
        if ($this->arParams['PAGE'] < 1) {
            $this->arParams['PAGE'] = 1;
        }
        
        
        // Список элементов папки.
        $pictures = Picture::getList(array(
            'order'  => array(Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP => 'ASC'),
            'limit'  => $this->arParams['PERPAGE'],
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => $filter
        ));
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        foreach ($pictures as $picture) {
            $item = $picture->getData();
            $item['PICTURE'] = $picture->getSmallPreviewImageSrc();
            
            $this->arResult['ITEMS'] []= $item ;
        }
        unset($item, $picture);
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
