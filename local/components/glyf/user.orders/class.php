<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\User;

class UserOrdersComponent extends \CBitrixComponent
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
        
        
        // Общее количество.
        $result = Sale::getList(array(
            'filter' => array(Sale::FIELD_USER_ID => $user->getID())
        ), false);
        
        $this->arResult['TOTAL'] = $result->getSelectedRowsCount();
        
        
        // Количество страниц.
        $pagescnt = ceil($this->arResult['TOTAL'] / $this->arParams['PERPAGE']);
        
        if ($this->arParams['PAGE'] > $pagescnt) {
            $this->arParams['PAGE'] = $pagescnt;
        }
        
        
        // Список элементов папки.
        $sales = Sale::getList(array(
            'order'  => array(Sale::FIELD_TIME => 'DESC'),
            'limit'  => ($this->arParams['PERPAGE']),
            'offset' => ($this->arParams['PAGE'] - 1) * $this->arParams['PERPAGE'],
            'filter' => array(Sale::FIELD_USER_ID => $user->getID())
        ));
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        foreach ($sales as $sale) {
            $item = $sale->getData();
            
            $item['PICTURE'] = $sale->getPicture()->getData();
            $item['LICENSE'] = $sale->getLicense()->getData();
            
            $this->arResult['ITEMS'] []= $item;
        }
        unset($item);
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
        
		return $this->arResult;
	}

}