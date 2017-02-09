<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\Sale;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;

class PDFPicturesComponent extends \CBitrixComponent
{   
    
	/** 
	 * ��������� ��������.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // ID ������������.
        $arParams['UID'] = (int) $arParams['UID'];
        
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
        
        if (empty($this->arParams['UID'])) {
            return;
        }
        
        $this->arResult = array(
            'PICTURES'   => array(),
            'FOLDERS'    => array(),
            'LIGHTBOXES' => array(),
        );
        
        // ������������.
        $this->arResult['USER'] = new Glyf\Oscar\User($this->arParams['UID']);
        
        
        $this->arParams['PIDS'] = array_filter(array_map('intval', $this->arParams['PIDS']));
        $this->arParams['FIDS'] = array_filter(array_map('intval', $this->arParams['FIDS']));
        $this->arParams['LIDS'] = array_filter(array_map('intval', $this->arParams['LIDS']));
        
        
        
        // �����������.
        if (!empty($this->arParams['PIDS'])) {
            $this->getPictures();
        }
        
        // �����.
        if (!empty($this->arParams['FIDS'])) {
            $this->getFolders();
        }
        
        // ��������.
        if (!empty($this->arParams['LIDS'])) {
            $this->getLightboxes();
        }
        
		// ����������� ������� ����������.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
    
    
    /**
     * ��������� �����������.
     */
    public function getPictures()
    {
        $pictures = Picture::getList(array(
            'filter' => array(
                Picture::FIELD_ID => array_filter($this->arParams['PIDS']),
                // Picture::FIELD_USER_ID => $this->arResult['USER']->getID(),
            )
        ));
        
        $this->arResult['PICTURES'] = $pictures;
    }
    
    
    /**
     * ��������� �����������.
     */
    public function getFolders()
    {
        $folders = Folder::getList(array(
            'filter' => array(
                Folder::FIELD_ID   => array_filter($this->arParams['FIDS']), 
                Folder::FIELD_USER => $this->arResult['USER']->getID(),
            )
        ));
        
        foreach ($folders as $folder) {
            $items = $folder->getPictures();
            if (empty($items)) {
                continue;
            }
            $item = array(
                'TITLE' => $folder->getTitle(),
                'ITEMS' => $items,
            );
            $this->arResult['FOLDERS'] []= $item;
        }
    }
    
    
    
    /**
     * ��������� �����������.
     */
    public function getLightboxes()
    {
        $lightboxes = Lightbox::getList(array(
            'filter' => array(
                Lightbox::FIELD_ID   => array_filter($this->arParams['LIDS']), 
                Lightbox::FIELD_USER => $this->arResult['USER']->getID(),
            )
        ));
        
        foreach ($lightboxes as $lightbox) {
            $items = $lightbox->getPictures();
            if (empty($items)) {
                continue;
            }
            $item = array(
                'TITLE' => $lightbox->getTitle(),
                'ITEMS' => $items,
            );
            $this->arResult['LIGHTBOXES'] []= $item;
        }
    }
}














