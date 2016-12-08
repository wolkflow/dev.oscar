<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class PDFPicturesComponent extends \CBitrixComponent
{   
    
	/** 
	 * ��������� ��������.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ID �����������.
        $arParams['PIDS'] = (array) $arParams['PIDS'];
        
        // ID ����� �����������.
        $arParams['FIDS'] = (array) $arParams['FIDS'];
        
        // ID ��������� �����������.
        $arParams['LIDS'] = (array) $arParams['LIDS'];
        
        
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
        
        $this->arResult = array(
            'PICTURES'   => array(),
            'FOLDERS'    => array(),
            'LIGHTBOXES' => array(),
        );
        
        // �����������.
        if (!empty($this->arParams['PIDS'])) {
            
        }
        
        // �����.
        if (!empty($this->arParams['FIDS'])) {
            
        }
        
        // ��������.
        if (!empty($this->arParams['LIDS'])) {
            
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
