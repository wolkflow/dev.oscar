<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class StatisticFoldersDetail extends \CBitrixComponent
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
        $filter = array(Folder::FIELD_USER => $user->getID());
        
        if (!empty($this->arParams['TITLE'])) {
            $filter[Folder::FIELD_TITLE] = '%'.$this->arParams['TITLE'].'%';
        }
        
        
        // Общее количество.
        $result = Folder::getList(array(
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
        $folders = Folder::getList(array(
            'order'  => array(Folder::FIELD_TITLE => 'ASC'),
            'limit'  => $this->arParams['PERPAGE'],
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => $filter
        ));
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        foreach ($folders as $folder) {
            $this->arResult['ITEMS'] []= $folder->getData();
        }
        unset($item, $picture);
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
