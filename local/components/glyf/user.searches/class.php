<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Glyf\Oscar\Search;

class UserSearchesComponent extends \CBitrixComponent
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
        
        // Список сохраненных поисков.
        $this->arResult = array('ITEMS' => array());
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        
        // Сохраненные поиски.
        $this->arResult['ITEMS'] = array();
        $items = Search::getList(array('filter' => array(Search::FIELD_USER => $user->getID())));
        foreach ($items as $item) {
            $this->arResult['ITEMS'][$item->getID()] = array('TITLE' => $item->getTitle(), 'FILTER' => $item->getFields());
        }
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
