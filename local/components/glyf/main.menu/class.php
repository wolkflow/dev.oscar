<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class MainMenuComponent extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
	}
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
		global $USER;
		
		Loader::includeModule('glyf.core');
		
        $cache = new CPHPCache();
        $ctime = 600;
        $ccode = 'main-counts';
        $cpath = '/onpage/';
        
        if ($ctime > 0 && $cache->InitCache($ctime, $ccode, $cpath)) {
            $this->arResult = $cache->getVars();
        } else {
            $result = CIBlockElement::getList(array(), array('IBLOCK_ID' => IBLOCK_BLOG_ID, 'ACTIVE' => 'Y'));
            $bcount = (int) $result->SelectedRowsCount();
            
            $this->arResult = array(
                'COUNT_COLLECTIONS' => Glyf\Oscar\Collection::getCount(array('IBLOCK_ID' => IBLOCK_COLLECTIONS_ID, 'DEPTH_LEVEL' => 1)),
                'COUNT_OBJECTS'     => Glyf\Oscar\Picture::getCount(array('filter' => array(Glyf\Oscar\Picture::FIELD_MODERATE => true))),
                'COUNT_SUBSCRIBES'  => Glyf\Oscar\Subscribe::getCount(),
                'COUNT_ARTICLES'    => $bcount,
            );
            
            if ($cache->StartDataCache()) {
                 $cache->EndDataCache($this->arResult);
            }
        }
        
		
		$this->includeComponentTemplate();
	}
}