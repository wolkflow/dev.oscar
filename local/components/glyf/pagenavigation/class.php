<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Partner;
use Glyf\Oscar\User;

class PageNavigationComponent extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ID блока с навигацией.
        $arParams['JSID'] = (string) $arParams['JSID'];
        
        // Общее количество.
        $arParams['TOTAL'] = (int) $arParams['TOTAL'];
        
        // Количество на странице.
        $arParams['PERPAGE'] = (int) $arParams['PERPAGE'];
        
        // Текущая странциа.
        $arParams['CURRENT'] = (int) $arParams['CURRENT'];
        
        // Сжатый режим.
        $arParams['SHORT'] = (bool) $arParams['SHORT'];
        
        // Количество страниц рядом.
        $arParams['DELTA'] = (int) $arParams['DELTA'];
        
        
        return $arParams;
	}
	
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
        // Данные.
        $this->arResult = $this->arParams;
           
        // Общее количество страниц.
        $this->arResult['COUNT'] = ceil($this->arParams['TOTAL'] / $this->arParams['PERPAGE']);
        if ($this->arResult['COUNT'] <= 0) {
            $this->arResult['COUNT'] = 1;
        }
        
        // Предыдущая страница.
        $this->arResult['PREV'] = ($this->arResult['CURRENT'] <= 1) 
                                  ? (1) 
                                  : ($this->arResult['CURRENT'] - 1);
        
        // Следующая страница.
        $this->arResult['NEXT'] = ($this->arResult['CURRENT'] >= $this->arResult['COUNT']) 
                                  ? ($this->arResult['COUNT']) 
                                  : ($this->arResult['CURRENT'] + 1);
        
        if (!$this->arParams['SHORT']) {
            $this->arResult['PAGES'] = array();
            
            $inf = $this->arResult['CURRENT'] - $this->arResult['DELTA'];
            $sup = $this->arResult['CURRENT'] + $this->arResult['DELTA'];
            
            // Первые страницы.
            if ($inf > 1) {
                $this->arResult['PAGES'] []= array('page' => 1, 'link' => '', 'mock' => false);
                
                if ($inf > 2) {
                    $this->arResult['PAGES'] []= array('page' => 1, 'link' => '', 'mock' => true);
                }
            }
            
            // Средние страницы.
            for ($i = $inf; $i <= $sup; $i++) {
                if ($i < 1 || $i > $this->arResult['COUNT']) {
                    continue;
                }
                $this->arResult['PAGES'] []= array('page' => 1, 'link' => '', 'mock' => false, 'current' => ($i == $this->arResult['CURRENT']));
            }
            
            // Последнгие страницы.
            if ($sup < $this->arResult['COUNT']) {
                if ($sup < $this->arResult['COUNT'] - 1) {
                    $this->arResult['PAGES'] []= array('page' => '...', 'link' => '', 'mock' => true);
                }
                $this->arResult['PAGES'] []= array('page' => $this->arResult['COUNT'], 'link' => '', 'mock' => false);
            }
        }
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
