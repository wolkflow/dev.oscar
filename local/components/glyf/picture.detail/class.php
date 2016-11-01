<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;

class PicturesDetail extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Идентификатор.
        $arParams['PID'] = (int) $arParams['PID'];
        
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
        
        if (empty($this->arParams['PID'])) {
            return;
        }
        
        // Картина.
        $picture = new Picture($this->arParams['PID']);
        
        // Коллекция.
        $collection = $picture->getCollection();
        
        // Техники.
        $techniques = $picture->getTechniques();
        
        
        
        // Данные.
        $this->arResult['PICTURE']    = $picture->getData();
        $this->arResult['COLLECTION'] = $collection->getData();
        $this->arResult['NAVIGATION'] = $collection->getChains();
        
        $this->arResult['PICTURE']['AUTHOR'] = $picture->getAuthor()->getName();
        $this->arResult['PICTURE']['HOLDER'] = $picture->getHolder()->getName();
        $this->arResult['PICTURE']['COLLECTION'] = $this->arResult['NAVIGATION'][1];
        $this->arResult['PICTURE']['TECHNIQUES'] = array();
        $this->arResult['PICTURE']['PLACE'] = array();
        
        $this->arResult['PICTURE']['FILE'] = array(
            'SIZE'   => $picture->getFileSize(),
            'WIDTH'  => $picture->getImageWidth(),
            'HEIGHT' => $picture->getImageHeight(),
            'EXT'    => $picture->getFileExtension(),
        ); 
        
        foreach ($techniques as $technique) {
            $this->arResult['PICTURE']['TECHNIQUES'][$technique->getID()] = $technique->getName();
        }
        
        if ($picture->getPlaceCountryID() > 0 && ($country = $picture->getPlaceCountry())) {
            $this->arResult['PICTURE']['PLACE']['COUNTRY'] = $country->getName();
        }
        
        if ($picture->getPlaceCityID() > 0 && ($city = $picture->getPlaceCity())) {
            $this->arResult['PICTURE']['PLACE']['CITY'] = $city->getName();
        }
        
        
        // Изображения.
        $this->arResult['PICTURE']['IMAGE_PREVIEW_SRC'] = $picture->getPreviewImageSrc();
        $this->arResult['PICTURE']['IMAGE_PREVIEW_WATER_MARK_SRC'] = $picture->getPreviewImageWMSrc();
        
        // Доступы.
        $this->arResult['ACCESS'] = array(
            'BUY'         => false,
            'INFO'        => false,
            'ZOOM'        => false,
            'WATERMARK'   => false,
            'DOWNLOAD'    => false,
            'DOWNLOAD_IP' => false,
        );
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
