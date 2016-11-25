<?php

use Bitrix\Main\Application; 
use Bitrix\Main\Context; 
use Bitrix\Main\Request;
use Bitrix\Main\Server;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Localization\Loc;

use Glyf\Core\Helpers\HLBlock as HLBlockHelper;
use Glyf\Core\Helpers\IBlock as IBlockHelper;
use Glyf\Core\Helpers\NumConvertor;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;


class PictureUpload extends \CBitrixComponent
{
    const IMAGE_MIN_SIZE = 700;
    
    
    protected static $user;
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Существующее изображение.
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
        
        // Пользователь.
        $this->user = new User();
        
        // Данные.
		$this->arResult = array('ERRORS' => array());
		
        // Параметры.
        $this->prepare();
        
        
        // Изображение.
        $picture = null;
        if (!empty($this->arParams['PID'])) {
            $picture = new Picture($this->arParams['PID']);
            
            if (!$picture->isBelongsToUser()) {
                echo 'Изображение не найдено';
                return;
            }
            
            // Изображения.
            $this->arResult['PICTURE']['SRC'] = $picture->getPreviewImageSrc();
        }
        
        // Конвертация данных.
        if (!empty($this->arParams['PID'])) {
            $this->arResult['DATA'] = $this->convert($picture);
        }
        
        
        
        
        // Запрос.
        $request = Context::getCurrent()->getRequest();
        
        // Обработка данных.
        if ($request->isPost()) {
            
            // Данные.
            $this->arResult['DATA'] = $request->getPostList();
            
            try {
                $pid = $this->process($this->arResult['DATA']);
            } catch (Exception $e) {
                $this->arResult['ERRORS'] []= $e->getMessage();
            }
            
            if ($pid > 0) {
                $this->arResult['SUCCESS'] = true;
                
                $picture = new Glyf\Oscar\Picture($pid);
                
                $this->arResult['DATA'] = $this->convert($picture);
            }
        }
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
    
    
    /**
     * Получение пользователя.
     */
    public function getUser()
    {
        return $this->user;
    }
    
    
    /**
     * Подготовка данных для вывода.
     */
    public function prepare()
    {
        $result = array();
        
        // Свойства HL-блока картин.
        $props = HLBlockHelper::getProps(HLBLOCK_PICTURES_ID, 'FIELD_NAME', 'ID');
        
        
        // Папки пользователя.
        $items = Folder::getUserFolders($this->getUser()->getID());
        $result['FOLDERS'] = array();
        foreach ($items as $item) {
            $result['FOLDERS'][$item->getID()] = $item->getTitle();
        }
        
        // Жанр.
        $result['GENRE'] = array();
        foreach ($props[Picture::FIELD_GENRE]['ENUMS'] as $item) {
            $result['GENRE'][$item['ID']] = $item['XML_ID'];
        }
        
        // Цвет.
        $result['COLOR'] = array();
        foreach ($props[Picture::FIELD_COLOR]['ENUMS'] as $item) {
            $result['COLOR'][$item['ID']] = $item['XML_ID'];
        }
        
        // Правовой режим.
        $result['LEGAL'] = array();
        foreach ($props[Picture::FIELD_LEGAL]['ENUMS'] as $item) {
            $result['LEGAL'][$item['ID']] = $item['XML_ID'];
        }
        
        
        $this->arResult['PARAMS'] = $result;
        
        return $result;
    }
    
    
    /**
     * Проверка данных.
     */
	public function check($data)
    {
        $result = true;
        
        
        return $result;
    }
    
    
    /**
     * Преобразование данных.
     */
	public function process($data)
    {
        $user = new Glyf\Oscar\User();
        
        $fields = array();
        
        
        // При загрузке нового изображения.
        if (empty($this->arParams['PID'])) {
            
            // Сохранение изображения.
            $file = $_FILES['FILE'];
        
            // Ошибка загрузки файла.
            if (empty($file) || !is_readable($file['tmp_name'])) {
                throw new Glyf\Core\System\Exception('Файл не загружен');
            }
            
            $sizes = getimagesize($file['tmp_name']);
            
            if ($sizes[0] < self::IMAGE_MIN_SIZE || $sizes[1] < self::IMAGE_MIN_SIZE) {
                throw new Glyf\Core\System\Exception('Изображение меньше необходимого размера');
            }
        }
        
        if ($data['FOLDER_SET'] == 'CREATE' && empty($data['FOLDER_TITLE'])) {
            throw new Glyf\Core\System\Exception('Не введено название папки для загрузки');
        }
        
        if ($data['FOLDER_SET'] != 'CREATE' && empty($data['FOLDER_ID'])) {
            throw new Glyf\Core\System\Exception('Не выбрана папка для загрузки');
        }
        
        if (empty($data['TITLE'])) {
            throw new Glyf\Core\System\Exception('Не введно название');
        }
        
        if (empty($data['COLLECTION'])) {
            throw new Glyf\Core\System\Exception('Не выбрана коллекция для загрузки');
        }
        
        
        // Создание директории.
        if ($data['FOLDER_SET'] == 'CREATE') {
            $folder = new Folder();
            $result = $folder->add(array(
                'UF_TITLE' => strval($data['FOLDER_TITLE']),
                'UF_USER'  => $user->getID(),
                'UF_TIME'  => new DateTime(),
            ));
            
            if (!$result) {
                throw new Glyf\Core\System\Exception('Не удалось создать папку');
            }
            $fields[Picture::FIELD_FOLDER] = $folder->getID();
        } else {
            $fields[Picture::FIELD_FOLDER] = (int) $data['FOLDER_ID'];
            
            $folder = new Glyf\Oscar\Folder($fields[Picture::FIELD_FOLDER]);
            
            if (!$folder->exists()) {
                throw new Glyf\Core\System\Exception('Папка не найдена');
            }
        }
        
        
        // При загрузке нового изображения.
        if (empty($this->arParams['PID'])) {
            // Загружаемый файл.
            $filename = $file['tmp_name'] . '.jpg';
            
            // переименование с расширением.
            rename($file['tmp_name'], $filename);
            
            $fnames = Picture::makePreviewFiles($filename);
            $unames = array();
            foreach ($fnames as $code => $fname) {
                $unames[$code] = CFile::SaveFile(CFile::MakeFileArray($fname), 'preview');
            }
            $fields[Picture::FIELD_FILE] = CFile::SaveFile(CFile::MakeFileArray($filename), 'original');
            $fields[Picture::FIELD_PREVIEW_FILE] = $unames['PREVIEW'];
            $fields[Picture::FIELD_PREVIEW_FILE_WATERMARK] = $unames['PREVIEW_WM'];
            $fields[Picture::FIELD_SMALL_FILE] = $unames['SMALL_PREVIEW'];
            $fields[Picture::FIELD_SMALL_FILE_WATERMARK] = $unames['SMALL_PREVIEW_WM'];
        }
        
        
        // Заголовок.
        $fields[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] = (string) $data['TITLE'];
        
        // Автор.
        $fields[Picture::FIELD_AUTHOR]      = (int) $data['AUTHOR_ID'];
        $fields[Picture::FIELD_AUTHOR_CAND] = (string) $data['AUTHOR_TITLE'];
        
        // Правообладатель.
        // $fields[Picture::FIELD_HOLDER] = (int) $data['HOLDER_ID'];
        // $fields[Picture::FIELD_HOLDER_CAND] = (string) $data['HOLDER_TITLE'];
        
        // Дата.
        $isyear = (string) $data['ISYEAR'];
        
        if ($isyear == 'YEAR') {
            if (!empty($data['PERIOD'])) {
                $eraK = ($data['PERIOD_ERA'] == Picture::PROP_TIME_AD) ? (1) : (-1);
                
                $fields[Picture::FIELD_PERIOD_FROM] = (int) $data['PERIOD'] * $eraK;
                $fields[Picture::FIELD_PERIOD_TO]   = (int) $data['PERIOD'] * $eraK;
            } else {
                $eraKF = ($data['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) ? (1) : (-1);
                $eraKT = ($data['PERIOD_TO_ERA']   == Picture::PROP_TIME_AD) ? (1) : (-1);
                
                $fields[Picture::FIELD_PERIOD_FROM]  = (int) $data['PERIOD_FROM'] * $eraKF;
                $fields[Picture::FIELD_PERIOD_TO]    = (int) $data['PERIOD_TO'] * $eraKT;
            }
            $fields[Picture::FIELD_IS_YEAR_FROM] = true;
            $fields[Picture::FIELD_IS_YEAR_TO]   = true;
        } else {
            // Конвертор римских числел.
            $convertor = new NumConvertor();
            
            if (!empty($data['PERIOD'])) {
                $eraK = ($data['PERIOD_ERA'] == Picture::PROP_TIME_AD) ? (1) : (-1);
                
                if (is_numeric($data['PERIOD'])) {
                    $period = intval($data['PERIOD']) * TIME_YEARS_IN_CENTURY;
                } else {
                    $period = (int) $convertor->fromRoman(strtoupper($data['PERIOD'])) * TIME_YEARS_IN_CENTURY;
                }
                
                if ($data['PERIOD_ERA'] == Picture::PROP_TIME_AD) {
                    $period -= TIME_YEARS_IN_CENTURY;
                }
                
                $fields[Picture::FIELD_PERIOD_FROM] = $period * $eraK;
                $fields[Picture::FIELD_PERIOD_TO]   = $period * $eraK;
            } else {
                $eraKF = ($data['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) ? (1) : (-1);
                $eraKT = ($data['PERIOD_TO_ERA']   == Picture::PROP_TIME_AD) ? (1) : (-1);
                
                if (is_numeric($data['PERIOD_FROM'])) {
                    $periodF = intval($data['PERIOD_FROM']) * TIME_YEARS_IN_CENTURY;
                } else {
                    $periodF = (int) $convertor->fromRoman(strtoupper($data['PERIOD_FROM'])) * TIME_YEARS_IN_CENTURY;
                }
                
                if (is_numeric($data['PERIOD_TO'])) {
                    $periodT = intval($data['PERIOD_TO']) * TIME_YEARS_IN_CENTURY;
                } else {
                    $periodT = (int) $convertor->fromRoman(strtoupper($data['PERIOD_TO'])) * TIME_YEARS_IN_CENTURY;
                }
                
                if ($data['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) {
                    $periodF -= TIME_YEARS_IN_CENTURY;
                }
                if ($data['PERIOD_TO_ERA'] == Picture::PROP_TIME_AD) {
                    $periodT -= TIME_YEARS_IN_CENTURY;
                }
                
                $fields[Picture::FIELD_PERIOD_FROM] = $periodF * $eraKF;
                $fields[Picture::FIELD_PERIOD_TO]   = $periodT * $eraKT;
            }
            $fields[Picture::FIELD_IS_YEAR_FROM] = false;
            $fields[Picture::FIELD_IS_YEAR_TO]   = false;
        }
        
        
        // Техника.
        $fields[Picture::FIELD_TECHNIQUE]      = array_filter(array_map('intval', array_keys((array) $data['TECHNIQUE'])));
        $fields[Picture::FIELD_TECHNIQUE_CAND] = array_filter(array_map('trim', (array) $data['TECHNIQUE_TITLE']));
        
        // Описание.
        $fields[Picture::FIELD_LANG_DESC_SFX . CURRENT_LANG_UP] = (string) $data['DESCRIPTION'];
        
        // Коллекция.
        $fields[Picture::FIELD_COLLECTION] = (int) $data['COLLECTION'];
        
        // Жанр.
        $fields[Picture::FIELD_GENRE] = (int) $data['GENRE'];
        
        // Страна.
        $fields[Picture::FIELD_PLACE_COUNTRY_ID] = (int) $data['COUNTRY_ID']; 
        
        // Страна (текст).
        $fields[Picture::FIELD_PLACE_COUNTRY] = (string) $data['COUNTRY'];
        
        // Город.
        $fields[Picture::FIELD_PLACE_CITY_ID] = (int) $data['UF_PLACE_CITY_ID'];
        
        // Город (текст).
        $fields[Picture::FIELD_PLACE_CITY] = (string) $data['UF_PLACE_CITY'];
        
        // Ширина.
        $fields[Picture::FIELD_WIDTH] = (int) $data['WIDTH'];
        
        // Высота.
        $fields[Picture::FIELD_HEIGHT] = (int) $data['HEIGHT'];
        
        // Цвет.
        $fields[Picture::FIELD_COLOR] = (int) $data['COLOR'];
        
        // Правовой режим.
        $fields[Picture::FIELD_LEGAL] = (int) $data['LEGAL'];
        
        // Ключевые слова.
        $fields[Picture::FIELD_KEYWORDS]      = array_filter(array_map('intval', array_keys((array) $data['KEYWORDS'])));
        $fields[Picture::FIELD_KEYWORDS_CAND] = array_filter(array_map('trim', (array) $data['KEYWORDS_TITLE']));
        
        // Провенанс.
        $fields[Picture::FIELD_PROVENANCE_SFX . CURRENT_LANG_UP] = (string) $data['PROVENANCE'];
        
        // Модель.
        $fields[Picture::FIELD_MODEL_SFX . CURRENT_LANG_UP] = (string) $data['MODEL'];
        
        // Раставрационные работы.
        $fields[Picture::FIELD_RESTORATION_SFX . CURRENT_LANG_UP] = (string) $data['RESTORATION'];
        
        // Эскизы.
        $fields[Picture::FIELD_SKETCHES_SFX . CURRENT_LANG_UP] = (string) $data['SKETCHES'];
        
        // Техническое состояние.
        $fields[Picture::FIELD_TECHNICAL_SFX . CURRENT_LANG_UP] = (string) $data['TECHNICAL'];
        
        // Заказчик.
        $fields[Picture::FIELD_CUSTOMER_SFX . CURRENT_LANG_UP] = (string) $data['CUSTOMER'];
        
        // Прочее.
        $fields[Picture::FIELD_OTHER_SFX . CURRENT_LANG_UP] = (string) $data['OTHER'];
        
        
        
        // Пользователь.
        $fields[Picture::FIELD_USER_ID] = $user->getID();
        
        // Язык заполнения данных.
        $fields[Picture::FIELD_LANG] = CURRENT_LANG_UP;
        
        // Время загрузки.
        $fields[Picture::FIELD_TIME] = new DateTime();
        
        // Модерация.
        $fields[Picture::FIELD_MODERATE] = false;
        
        
        // Добавление элемента.
        if (empty($this->arParams['PID'])) {
            $picture = new Picture();
            $result  = $picture->add($fields);
        } else {
            $picture = new Picture($this->arParams['PID']);
            $result  = $picture->update($fields);
        }
        
        if (!$result) {
        	throw new Glyf\Core\System\Exception('Не удалось сохранить данные');
		}
        return $result;
    }
    
    
    
    /**
     * Конвертация данных элемента в массив.
     */
    public function convert(Picture $picture)
    {
        // Данные.
        $data = $picture->getData();
        
        
        $items = $picture->getTechniques();
        $techniques = array();
        foreach ($items as $item) {
            $techniques[$item->getID()] = $item->getName();
        }
        
        $items = $picture->getKeywords();
        $keywords = array();
        foreach ($items as $item) {
            $keywords[$item->getID()] = $item->getName();
        }
        
        $country = $picture->getPlaceCountry();
        $city    = $picture->getPlaceCity();
        
        $result = array(
            'FOLDER_SET'    => 'EXIST',
            'FOLDER'        => $picture->getFolderID(),
            'TITLE'         => $picture->getTitle(),
            'AUTHOR_ID'     => $picture->getAuthorID(),
            'AUTHOR_TITLE'  => $picture->getAuthor()->getName(),
            'TECHNIQUE'     => $techniques,
            'DESCRIPTION'   => $picture->getDescription(),
            'COLLECTION'    => $picture->getCollectionID(),
            'GENRE'         => $picture->getGenreID(),
            'COUNTRY_ID'    => $picture->getPlaceCountryID(),
            'CITY_ID'       => $picture->getPlaceCityID(),
            'COUNTRY'       => ($picture->getPlaceCountryID() > 0) ? ($country->getName()) : (''),
            'CITY'          => ($picture->getPlaceCityID() > 0) ? ($city->getName()) : (''),
            'WIDTH'         => $picture->getWidth(),
            'HEIGHT'        => $picture->getHeight(),
            'COLOR'         => $picture->getColorID(),
            'LEGAL'         => $picture->getLegalID(),
            'KEYWORDS'      => $keywords,
            'PROVENANCE'    => $picture->getProvenance(),
            'MODEL'         => $picture->getModel(),
            'RESTORATION'   => $picture->getRestoration(),
            'SKETCHES'      => $picture->getSketches(),
            'TECHNICAL'     => $picture->getTechnical(),
            'CUSTOMER'      => $picture->getCustomer(),
            'OTHER'         => $picture->getOther(),
            'MODERATE'      => $picture->isModerate(),
            'MODERATE_TIME' => $picture->getModerateTime(),
            'MODERATE_TEXT' => $picture->getModerateText(),
        );
        
        
        
        $result['ISYEAR'] = ($data[Picture::FIELD_IS_YEAR_FROM]) ? ('YEAR') : ('CENTURY');
        
        if ($data[Picture::FIELD_PERIOD_FROM] == $data[Picture::FIELD_PERIOD_TO]) {
            $date = $data[Picture::FIELD_PERIOD_FROM];
            
            $result['PERIOD'] = ($result['ISYEAR'] == 'YEAR') ? (abs($date)) : ($numconv->toRoman(abs($date) / TIME_YEARS_IN_CENTURY));
            $result['PERIOD_ERA'] = ($date > 0) ? (Picture::PROP_TIME_AD) : (Picture::PROP_TIME_BC);
        } else {
            $dateF = $data[Picture::FIELD_PERIOD_FROM];
            $dateT = $data[Picture::FIELD_PERIOD_TO];
            
            $numconv = new NumConvertor();
            
            $result['PERIOD_FROM'] = ($result['ISYEAR'] == 'YEAR') ? (abs($dateF)) : ($numconv->toRoman(abs($dateF) / TIME_YEARS_IN_CENTURY));
            $result['PERIOD_TO']   = ($result['ISYEAR'] == 'YEAR') ? (abs($dateT)) : ($numconv->toRoman(abs($dateT) / TIME_YEARS_IN_CENTURY));
            
            $result['PERIOD_FROM_ERA'] = ($dateF > 0) ? (Picture::PROP_TIME_AD) : (Picture::PROP_TIME_BC);
            $result['PERIOD_TO_ERA']   = ($dateT > 0) ? (Picture::PROP_TIME_AD) : (Picture::PROP_TIME_BC);
        }
        
        
        return $result;
    }
}










