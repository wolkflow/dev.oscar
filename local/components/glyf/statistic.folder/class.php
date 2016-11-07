<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class StatisticFolderDetail extends \CBitrixComponent
{
    const PERPAGE = 30;
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Идентификатор.
        $arParams['FID'] = (int) $arParams['FID'];
        
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
        
        // Сортировка.
        $arParams['ORDER'] = (string) $arParams['ORDER'];
        
        switch ($arParams['ORDER']) {
            case ('ID'):
                $arParams['ORDER'] = array(Picture::FIELD_ID => 'DESC');
                break;
            
             case ('title'):
                $arParams['ORDER'] = array(Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP => 'ASC');
                break;
            
            case ('date'):
                $arParams['ORDER'] = array(Picture::FIELD_MODERATE => 'DESC', Picture::FIELD_MODERATE_TIME => 'ASC');
                break;
                
            case ('views'):
                $arParams['ORDER'] = array(Picture::FIELD_STAT_VIEWS => 'DESC');
                break;
                
            case ('sales'):
                $arParams['ORDER'] = array(Picture::FIELD_STAT_SALES => 'DESC');
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
        
        if (empty($this->arParams['FID'])) {
            return;
        }
        
        // Пользователь.
        $user = new User();
        
        
        // Папка.
        $folder = new Folder($this->arParams['FID']);
        
        
        // Общее количество.
        $result = Picture::getList(array(
            'filter' => array(Picture::FIELD_FOLDER => $folder->getID())
        ), false);
        
        $this->arResult['TOTAL'] = $result->getSelectedRowsCount();
        
        
        
        // Количество страниц.
        $pagescnt = ceil($this->arResult['TOTAL'] / $this->arParams['PERPAGE']);
        
        if ($this->arParams['PAGE'] > $pagescnt) {
            $this->arParams['PAGE'] = $pagescnt;
        }
        
        
        // Список элементов папки.
        $result = Picture::getList(array(
            'order'  => $this->arParams['ORDER'],
            'limit'  => $this->arParams['PERPAGE'],
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => array(
                Picture::FIELD_USER_ID => $user->getID(),
                Picture::FIELD_FOLDER  => $folder->getID()
            )
        ), false);
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        while ($item = $result->fetch()) {
            $this->arResult['ITEMS'] []= $item;
        }
        unset($item);
        
        //  Данные папки.
        $this->arResult['FOLDER'] = $folder->getData();
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
