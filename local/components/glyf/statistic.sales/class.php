<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class StatisticSalesComponent extends \CBitrixComponent
{
    const PERPAGE = 30;
    
    const PREFIX_TABLE_SALES    = 's.';
    const PREFIX_TABLE_PICTURES = 'p.';
    
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
                $arParams['ORDER'] = array(self::PREFIX_TABLE_SALES . Sale::FIELD_ORDER_ID => 'DESC');
                break;
            
             case ('title'):
                $arParams['ORDER'] = array(self::PREFIX_TABLE_PICTURES . Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP => 'ASC');
                break;
            
            case ('price'):
                $arParams['ORDER'] = array(self::PREFIX_TABLE_SALES . Sale::FIELD_PRICE => 'DESC');
                break;
            
            case ('date'):
                $arParams['ORDER'] = array(self::PREFIX_TABLE_SALES . Sale::FIELD_TIME => 'DESC');
                break;
            
            default:
                $arParams['ORDER'] = array(self::PREFIX_TABLE_SALES . Sale::FIELD_ID => 'DESC');
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
        $filter = array(self::PREFIX_TABLE_SALES . Sale::FIELD_UPLOADER_ID => $user->getID());
        
        if (!empty($this->arParams['TITLE'])) {
            $filter['~=' . self::PREFIX_TABLE_PICTURES . Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] = '%'.$this->arParams['TITLE'].'%';
        }
        
        if (!empty($this->arParams['PERIOD_MIN'])) {
            $filter['>=' . self::PREFIX_TABLE_SALES . Sale::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MIN']));
        } else {
            
        }
        
        if (!empty($this->arParams['PERIOD_MAX'])) {
            $filter['<=' . self::PREFIX_TABLE_SALES . Sale::FIELD_TIME] = date('Y-m-d', strtotime($this->arParams['PERIOD_MAX']));
        } else {
            
        }
        
        if ($this->arParams['PAGE'] <= 0) {
            $this->arParams['PAGE'] = 1;
        }
        
        // Параметры поиска.
        $params = array(
            'order'  => $this->arParams['ORDER'],
            'limit'  => $this->arParams['PERPAGE'],
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => $filter
        );
        
        
        // Общее количество.
        $result = Sale::getSalesList(array('filter' => $params['filter']), false);
        
        $this->arResult['TOTAL'] = $result->getSelectedRowsCount();
        
        // Количество страниц.
        $pagescnt = ceil($this->arResult['TOTAL'] / $this->arParams['PERPAGE']);
        
        if ($this->arParams['PAGE'] > $pagescnt) {
            $this->arParams['PAGE'] = $pagescnt;
        }
        
        
        // Список элементов папки.
        $this->arResult['ITEMS'] = Sale::getSalesList($params);
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
