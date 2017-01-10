<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\User;

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
        
        Loc::loadMessages(__FILE__);
        
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
                $timeF = Loc::getMessage('GL_AGE_YEAR');
            }
            
            if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_TO]) {
                $periodT = $convertor->toRoman($periodT / TIME_YEARS_IN_CENTURY);
                $timeT = Loc::getMessage('GL_AGE_CENTURY');
            } else {
                $timeT = Loc::getMessage('GL_AGE_YEAR');
            }
            $periodF = ($periodF . $timeF . $eraF);
            $periodT = ($periodT . $timeT . $eraT);
            
            $this->arResult['PICTURE']['PERIOD'] = $periodF . ' &ndash; ' . $periodT;
        }
        
        
        // Изображения.
        $this->arResult['PICTURE']['IMAGE_PREVIEW_SRC'] = $picture->getPreviewImageSrc();
        $this->arResult['PICTURE']['IMAGE_PREVIEW_WATERMAK_SRC'] = $picture->getPreviewImageWMSrc();
        
        // Доступы.
        $this->arResult['ACCESS'] = array(
            'BUY'         => false,
            'INFO'        => false,
            'ZOOM'        => false,
            'WATERMARK'   => false,
            'DOWNLOAD'    => false,
            'DOWNLOAD_IP' => false,
        );
        
        if (!$user->isPartner()) {
            $usertariff = $user->getUserTariff();
            
            if ($usertariff) {
                
                // Доступы.
                $this->arResult['ACCESS'] = array(
                    'BUY'         => true,
                    'INFO'        => $usertariff->canInfoView(),
                    'ZOOM'        => $usertariff->canZoom(),
                    'WATERMARK'   => $usertariff->canWatermark(),
                    'DOWNLOAD'    => $usertariff->canDownload($picture->getID()),
                    'DOWNLOAD_IP' => false,
                );
                
                // Ссылка на скачивание.
                if ($this->arResult['ACCESS']['DOWNLOAD']) {
                    $this->arResult['DOWNLOAD_LINK'] = $picture->getDownloadLink();
                }
            }
        }
        
        // Добавление просмотра в статистику.
        $picture->recordStatisticView($user->getID());
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
