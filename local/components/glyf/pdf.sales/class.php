<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class PDFSalesComponent extends \CBitrixComponent
{   
    const PREFIX_TABLE_SALES    = 's.';
    const PREFIX_TABLE_PICTURES = 'p.';
    
    
	/** 
	 * ��������� ��������.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ���������� �� ��������.
        $arParams['IDS'] = (array) $arParams['IDS'];
        
        return $arParams;
	}
	
	
	
	/**
	 * ���������� ����������.
	 */
	public function executeComponent()
    {
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
			return;
		}
        
        $this->arParams['IDS'] = array_filter(array_map('intval', $this->arParams['IDS']));
        
        
        // ������ ��������� �����.
        $this->arResult['ITEMS'] = Sale::getSalesList(array(
            'filter' => array(self::PREFIX_TABLE_SALES . Sale::FIELD_ID => $this->arParams['IDS'])
        ));
        
        
		// ����������� ������� ����������.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
