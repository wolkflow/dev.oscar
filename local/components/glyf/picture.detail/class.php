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
            $era    = ($period < 0)  ? ('до н.э.') : ('н.э.');
            $period = abs($period);
            
            if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_FROM]) {
                $period = $convertor->toRoman($period / TIME_YEARS_IN_CENTURY);
                $time = ' в. ';
            } else {
                $time = ' в. ';
            }
            $this->arResult['PICTURE']['PERIOD'] = ($period . $time . $era);
        } else {
            $periodF = $this->arResult['PICTURE'][Picture::FIELD_PERIOD_FROM];
            $periodT = $this->arResult['PICTURE'][Picture::FIELD_PERIOD_TO];
            $eraF    = ($periodF < 0)  ? ('до н.э.') : ('н.э.');
            $eraT    = ($periodT < 0)  ? ('до н.э.') : ('н.э.');
            $periodF = abs($periodF);
            $periodT = abs($periodT);
            
            if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_FROM]) {
                $periodF = $convertor->toRoman($periodF / TIME_YEARS_IN_CENTURY);
                $timeF = ' в. ';
            } else {
                $timeF = ' г. ';
            }
            
            if (!$this->arResult['PICTURE'][Picture::FIELD_IS_YEAR_TO]) {
                $periodT = $convertor->toRoman($periodT / TIME_YEARS_IN_CENTURY);
                $timeT = ' в. ';
            } else {
                $timeT = ' г. ';
            }
            $periodF = ($periodF . $timeF . $eraF);
            $periodT = ($periodT . $timeT . $eraT);
            
            $this->arResult['PICTURE']['PERIOD'] = $periodF . ' &ndash; ' . $periodT;
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
        
        if (!$user->isPartner()) {
            $tariff = $user->getUserTariff();
            
            if ($tariff) {
                // Доступы.
                $this->arResult['ACCESS'] = array(
                    'BUY'         => true,
                    'INFO'        => $tariff->canInfoView(),
                    'ZOOM'        => $tariff->canZoom(),
                    'WATERMARK'   => $tariff->canWatermark(),
                    'DOWNLOAD'    => $tariff->canDownload(),
                    'DOWNLOAD_IP' => false,
                );
                
                // Ссылка на скачивание.
                if ($this->arResult['ACCESS']['DOWNLOAD']) {
                    $this->arResult['DOWNLOAD_LINK'] = $picture->getDownloadLink();
                }
            }
        }
        
        
        // Добавление просмотра в статистику.
        $view = new Glyf\Oscar\Statistic\View();
        $view->add(array(
            Glyf\Oscar\Statistic\View::FIELD_TIME        => date('d.m.Y H:i:s'),
            Glyf\Oscar\Statistic\View::FIELD_TYPE        => 'PICTURE',
            Glyf\Oscar\Statistic\View::FIELD_IP          => $_SERVER['REMOTE_ADDR'],
            Glyf\Oscar\Statistic\View::FIELD_USER_ID     => $user->getID(),
            Glyf\Oscar\Statistic\View::FIELD_UPLOADER_ID => $picture->getUserID(),
            Glyf\Oscar\Statistic\View::FIELD_ELEMENT_ID  => $picture->getID(),
        ));
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}
