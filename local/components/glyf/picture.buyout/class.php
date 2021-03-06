<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\License;
use Glyf\Oscar\User;

class PictureBuyoutComponent extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Идентификатор.
        $arParams['PID'] = (int) $arParams['PID'];
        
        // Идентификатор корзины.
        $arParams['BID'] = (int) $arParams['BID'];
        
        return $arParams;
	}
	
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
        if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
        
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
			return;
		}
        
        Loc::loadMessages(__FILE__);
        
        if (!empty($this->arParams['PID'])) {
        
            // Пользователь.
            $user = new User();
            
            // Картина.
            $picture = new Picture($this->arParams['PID']);
            
            // Коллекция.
            $collection = $picture->getCollection();
            
            // Техники.
            $techniques = $picture->getTechniques();
            
            // Ключевые слова.
            $keywords = $picture->getKeywords();
            
            
            // Данные.
            $this->arResult['PICTURE']    = $picture->getData();
            $this->arResult['COLLECTION'] = $collection->getData();
            $this->arResult['NAVIGATION'] = $collection->getChains();
            
            $this->arResult['PICTURE']['VIEWID'] = $picture->getViewID();
            $this->arResult['PICTURE']['AUTHOR'] = $picture->getAuthor()->getName();
            $this->arResult['PICTURE']['HOLDER'] = $picture->getHolder()->getName();
            $this->arResult['PICTURE']['COLLECTION'] = $this->arResult['NAVIGATION'][1];
            $this->arResult['PICTURE']['TECHNIQUES'] = array();
            $this->arResult['PICTURE']['KEYWORDS'] = array();
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
            
            foreach ($keywords as $keyword) {
                $this->arResult['PICTURE']['KEYWORDS'][$keyword->getID()] = $keyword->getName();
            }
            
            if ($picture->getPlaceCountryID() > 0 && ($country = $picture->getPlaceCountry())) {
                $this->arResult['PICTURE']['PLACE']['COUNTRY'] = $country->getName();
            }
            
            if ($picture->getPlaceCityID() > 0 && ($city = $picture->getPlaceCity())) {
                $this->arResult['PICTURE']['PLACE']['CITY'] = $city->getName();
            }
            
            
            // Период.
            $this->arResult['PICTURE']['PERIOD'] = '';
            $convertor = new Glyf\Core\Helpers\NumConvertor();
            if ($this->arResult['PICTURE'][Picture::FIELD_PERIOD_FROM] == $this->arResult['PICTURE'][Picture::FIELD_PERIOD_TO]) {
                $period = $this->arResult['PICTURE'][Picture::FIELD_PERIOD_FROM];
                $era    = ($period < 0)  ? (Loc::getMessage('GL_AGE_BC')) : (Loc::getMessage('GL_AGE_AD'));
                $period = abs($period);
                
                if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_FROM]) {
                    $period = $convertor->toRoman($period / TIME_YEARS_IN_CENTURY);
                    $time = Loc::getMessage('GL_AGE_CENTURY');
                } else {
                    $time = Loc::getMessage('GL_AGE_YEAR');
                }
                
                $this->arResult['PICTURE']['PERIOD'] = (!empty($period)) ? ($period . $time . $era) : ('');
            } else {
                $periodF = $this->arResult['PICTURE'][Picture::FIELD_PERIOD_FROM];
                $periodT = $this->arResult['PICTURE'][Picture::FIELD_PERIOD_TO];
                $eraF    = ($periodF < 0)  ? (Loc::getMessage('GL_AGE_BC')) : (Loc::getMessage('GL_AGE_AD'));
                $eraT    = ($periodT < 0)  ? (Loc::getMessage('GL_AGE_BC')) : (Loc::getMessage('GL_AGE_AD'));
                $periodF = abs($periodF);
                $periodT = abs($periodT);
                
                if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_FROM]) {
                    $periodF = $convertor->toRoman($periodF / TIME_YEARS_IN_CENTURY);
                    $timeF = Loc::getMessage('GL_AGE_CENTURY');
                } else {
                    $timeF = ' г. ';
                }
                
                if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_TO]) {
                    $periodT = $convertor->toRoman($periodT / TIME_YEARS_IN_CENTURY);
                    $timeT = Loc::getMessage('GL_AGE_CENTURY');
                } else {
                    $timeT = ' г. ';
                }
                $periodF = ($periodF . $timeF . $eraF);
                $periodT = ($periodT . $timeT . $eraT);
                
                $this->arResult['PICTURE']['PERIOD'] = $periodF . ' &ndash; ' . $periodT;
            }
            
            // Корзина.
            $this->arResult['BASKET'] = CSaleBasket::getByID($this->arParams['BID']);
                        
            // Изображения.
            $this->arResult['PICTURE']['IMAGE_PREVIEW_SRC'] = $picture->getSmallPreviewImageSrc();
            
            // Лицензии.
            $this->arResult['LICENSES'] = License::getList(array(
                'filter' => array(License::FIELD_ROOT => false),
                'order'  => array(Glyf\Oscar\License::FIELD_ID   => 'ASC')
            ));
        }
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
