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
        
        if (empty($arParams['ORDER'])) {
             $arParams['ORDER'] = array(Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP => 'ASC');
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
        
        $pictures = Picture::getList(array(
            'order'  => $this->arParams['ORDER'],
            'limit'  => $this->arParams['PERPAGE'],
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => array(
                Picture::FIELD_USER_ID => $user->getID(),
                Picture::FIELD_FOLDER  => $folder->getID()
            )
        ));
        
        $result = Picture::getList(array(
            'filter' => array(Picture::FIELD_FOLDER => $folder->getID())
        ), false);
        
        // Общее количество.
        $this->arResult['TITLE'] = $result->getSelectedRowsCount();
        
        // Картины.
        $items = array();
        foreach ($pictures as $picture) {
            $item = $picture->getData();
            
            $item['VIEWS'] = $picture->getStatisticViewsCount();
            $item['SALES'] = $picture->getStatisticSalesCount();
            
            $items []= $item;
        }
        
        
        $this->arResult['FOLDER'] = $folder->getData();
        $this->arResult['ITEMS']  = $items;
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
