<?php

namespace Glyf\Oscar;

// JWT.
require_once($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/JWT.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/BeforeValidException.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/ExpiredException.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/SignatureInvalidException.php');


use Glyf\Core\System\HLBlockModel;
use \Firebase\JWT\JWT;
use \Firebase\JWT\BeforeValidException;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;



class Picture extends HLBlockModel
{
	static protected $hlblockID = HLBLOCK_PICTURES_ID;
	
    
	// Идентификатор.
	const FIELD_ID              = 'ID';
    
    // Пользователь.
    const FIELD_USER_ID         = 'UF_USER_ID';
    
    // Текстовые поля.
	const FIELD_LANG_TITLE_SFX  = 'UF_LANG_TITLE_';
	const FIELD_LANG_TITLE_RU   = 'UF_LANG_TITLE_RU';
	const FIELD_LANG_TITLE_EN   = 'UF_LANG_TITLE_EN';
    
    const FIELD_LANG_DESC_SFX   = 'UF_LANG_DESC_';
	const FIELD_LANG_DESC_RU    = 'UF_LANG_DESC_RU';
	const FIELD_LANG_DESC_EN    = 'UF_LANG_DESC_EN';
    
    const FIELD_PROVENANCE_SFX  = 'UF_LANG_INFO_PROV_';
    const FIELD_PROVENANCE_RU   = 'UF_LANG_INFO_PROV_RU';
    const FIELD_PROVENANCE_EN   = 'UF_LANG_INFO_PROV_EN';
    const FIELD_MODEL_SFX       = 'UF_LANG_INFO_MDL_';
    const FIELD_MODEL_RU        = 'UF_LANG_INFO_MDL_RU';
    const FIELD_MODEL_EN        = 'UF_LANG_INFO_MDL_EN';
    const FIELD_RESTORATION_SFX = 'UF_LANG_INFO_REST_';
    const FIELD_RESTORATION_RU  = 'UF_LANG_INFO_REST_RU';
    const FIELD_RESTORATION_EN  = 'UF_LANG_INFO_REST_EN';
    const FIELD_SKETCHES_SFX    = 'UF_LANG_INFO_SKTS_';
    const FIELD_SKETCHES_RU     = 'UF_LANG_INFO_SKTS_RU';
    const FIELD_SKETCHES_EN     = 'UF_LANG_INFO_SKTS_EN';
    const FIELD_TECHNICAL_SFX   = 'UF_LANG_INFO_TECH_';
    const FIELD_TECHNICAL_RU    = 'UF_LANG_INFO_TECH_RU';
    const FIELD_TECHNICAL_EN    = 'UF_LANG_INFO_TECH_EN';
    const FIELD_CUSTOMER_SFX    = 'UF_LANG_INFO_CUST_';
    const FIELD_CUSTOMER_RU     = 'UF_LANG_INFO_CUST_RU';
    const FIELD_CUSTOMER_EN     = 'UF_LANG_INFO_CUST_EN';
    const FIELD_OTHER_SFX       = 'UF_LANG_INFO_ETC_';
    const FIELD_OTHER_RU        = 'UF_LANG_INFO_ETC_RU';
    const FIELD_OTHER_EN        = 'UF_LANG_INFO_ETC_EN';
    
    
    // Справочники.
	const FIELD_AUTHOR          = 'UF_AUTHOR';
	const FIELD_HOLDER          = 'UF_HOLDER';
    const FIELD_KEYWORDS        = 'UF_KEYWORDS';
    const FIELD_TECHNIQUE       = 'UF_TECHNIQUE';
    const FIELD_PLACE           = 'UF_PLACE';
    
    // Кандидаты для справочника. 
    const FIELD_AUTHOR_CAND     = 'UF_AUTHOR_CAND';
	const FIELD_HOLDER_CAND     = 'UF_HOLDER_CAND';
    const FIELD_KEYWORDS_CAND   = 'UF_KEYWORDS_CAND';
    const FIELD_TECHNIQUE_CAND  = 'UF_TECHNIQUE_CAND';
    
    // Раздел коллекции.
    const FIELD_COLLECTION      = 'UF_COLLECTION';
	
    // Местоположение.
    const FIELD_PLACE_COUNTRY_ID = 'UF_PLACE_COUNTRY_ID';
    const FIELD_PLACE_CITY_ID    = 'UF_PLACE_CITY_ID';
    const FIELD_PLACE_COUNTRY    = 'UF_PLACE_COUNTRY';
    const FIELD_PLACE_CITY       = 'UF_PLACE_CITY';
    
    // Свойства.
	const FIELD_GENRE           = 'UF_GENRE';
	const FIELD_WIDTH           = 'UF_WIDTH';
	const FIELD_HEIGHT          = 'UF_HEIGHT';
	const FIELD_COLOR           = 'UF_COLOR';
	const FIELD_LEGAL           = 'UF_LEGAL';
    const FIELD_FOLDER          = 'UF_FOLDER';
    
    
    // Изображения.
    const FIELD_FILE                    = 'UF_FILE';
    const FIELD_FILE_WATERMARK          = 'UF_FILE_WM';
    const FIELD_PREVIEW_FILE            = 'UF_PREVIEW_FILE';
    const FIELD_PREVIEW_FILE_WATERMARK  = 'UF_PREVIEW_FILE_WM';
    const FIELD_SMALL_FILE              = 'UF_SMALL_FILE';
    const FIELD_SMALL_FILE_WATERMARK    = 'UF_SMALL_FILE_WM';
    
    
    // Служебные данные.
	const FIELD_TIME            = 'UF_TIME';
    const FIELD_LANG            = 'UF_LANG';
	const FIELD_MODERATE        = 'UF_MODERATE';
    const FIELD_MODERATE_TEXT   = 'UF_MODERATE_TEXT';
	const FIELD_MODERATE_TIME   = 'UF_MODERATE_TIME';
    
    // Дата создания.
	const FIELD_PERIOD_FROM     = 'UF_PERIOD_FROM';
    const FIELD_PERIOD_TO       = 'UF_PERIOD_TO';
    const FIELD_IS_YEAR_FROM    = 'UF_IS_YEAR_FROM';
    const FIELD_IS_YEAR_TO      = 'UF_IS_YEAR_TO';
    //const FIELD_ERA_FROM        = 'UF_ERA_FROM';
    //const FIELD_ERA_TO          = 'UF_ERA_TO';
	
    
    // Статистика.
	const FIELD_STAT_VIEWS      = 'UF_STAT_VIEWS';
    const FIELD_STAT_LOADS      = 'UF_STAT_LOADS';
    const FIELD_STAT_SALES      = 'UF_STAT_SALES';
    
    
    
    const PROP_LEGAL_FULL_ID = 30;
    const PROP_LEGAL_NOCOMMERCIAL_ID = 31;
    
    const PROP_TIME_BC = 'BC'; // Before Christ
    const PROP_TIME_AD = 'AD'; // Anno Domini
    
    
    // Размеры дял превью.
    const IMAGE_WATERMARK_PATH   = '/local/templates/main/images/watermark.png';
    const IMAGE_WATERMARK_WIDTH  = 66;
    const IMAGE_WATERMARK_HEIGHT = 45;
    const IMAGE_PREVIEW_WIDTH    = 1000;
    const IMAGE_PREVIEW_HEIGHT   = 1000;
    const IMAGE_SMALL_WIDTH      = 545;
    const IMAGE_SMALL_HEIGHT     = 360;
    
    // Время на скачивание файла (секунд).
    const DOWNLOAD_EXPIRE = 86400;
    
    
    
    protected $fileinfo = array();
    
	
	/**
	 * Получение названия изображения.
	 */
	public function getTitle()
	{
        $this->load();
        
		return $this->get(self::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP);
	}
    
    
    /**
	 * Получение названия изображения.
	 */
	public function getTitleRU()
	{
        $this->load();
        
		return $this->get(self::FIELD_LANG_TITLE_RU);
	}
    
    
    
    /**
	 * Получение названия изображения.
	 */
	public function getTitleEN()
	{
        $this->load();
        
		return $this->get(self::FIELD_LANG_TITLE_EN);
	}
	
    
    /**
	 * Получение ID пользователя.
	 */
	public function getUserID()
	{
        $this->load();
        
		return intval($this->get(self::FIELD_USER_ID));
	}
    
    
    /**
	 * Получение ID папки.
	 */
    public function getFolderID()
    {
        $this->load();
        
        return $this->get(self::FIELD_FOLDER);
    }
    
    
    /**
     * Получение описание.
     */
    public function getDescription()
    {
        $this->load();
        
		return $this->get(self::FIELD_LANG_DESC_SFX . CURRENT_LANG_UP);
    }
    
    
	
	/**
	 * Получение ID автора.
	 */
	public function getAuthorID()
	{
        $this->load();
        
		return intval($this->get(self::FIELD_AUTHOR));
	}
    
    
    /**
	 * Получение автора.
	 */
	public function getAuthor()
	{
        return (new \Glyf\Oscar\Dictionaries\Author($this->getAuthorID()));
	}
	
	
	/**
	 * Получение ID правообладателя.
	 */
	public function getHolderID()
	{
        $this->load();
        
		return intval($this->get(self::FIELD_HOLDER));
	}
	
    
    /**
	 * Получение автора.
	 */
	public function getHolder()
	{
        return (new \Glyf\Oscar\Dictionaries\Holder($this->getHolderID()));
	}
    
	
	/**
	 * Получение ключевых слов.
	 */
	public function getKeywordsID()
	{
        $this->load();
        
		return $this->get(self::FIELD_KEYWORDS);
	}
	
    
    /**
	 * Получение техник.
	 */
	public function getKeywords()
	{
        $ids = $this->getKeywordsID();
        
        $result = array();
        
        foreach ($ids as $id) {
            $result[$id] = new \Glyf\Oscar\Dictionaries\Keyword($id);
        }
		return $result;
	}
    
    
    /**
	 * Получение ID техник.
	 */
	public function getTechniqueID()
	{
        $this->load();
        
		return $this->get(self::FIELD_TECHNIQUE);
	}
    
    
    /**
	 * Получение техник.
	 */
	public function getTechniques()
	{
        $ids = $this->getTechniqueID();
        
        $result = array();
        
        foreach ($ids as $id) {
            $result[$id] = new \Glyf\Oscar\Dictionaries\Technique($id);
        }
		return $result;
	}
    
    
    /**
     * Получение ID страны.
     */
    public function getPlaceCountryID()
    {
        $this->load();
        
        return $this->get(self::FIELD_PLACE_COUNTRY_ID);
    }
    
    
    /**
     * Получение ID города.
     */
    public function getPlaceCityID()
    {
        $this->load();
        
        return $this->get(self::FIELD_PLACE_CITY_ID);
    }
    
	
    /**
     * Получение текстового названия страны.
     */
    public function getPlaceCountryText()
    {
        $this->load();
        
        return $this->get(self::FIELD_PLACE_COUNTRY);
    }
    
    
    /**
     * Получение текстового названия города.
     */
    public function getPlaceCityText()
    {
        $this->load();
        
        return $this->get(self::FIELD_PLACE_CITY);
    }
    
    
    /**
     * Получение страны.
     */
    public function getPlaceCountry()
    {
        return (new \Glyf\Oscar\Dictionaries\PlaceCountry($this->getPlaceCountryID()));
    }
    
    
    /**
     * Получение города.
     */
    public function getPlaceCity()
    {
        return (new \Glyf\Oscar\Dictionaries\Placecity($this->getPlaceCityID()));
    }
    
    
    /**
     * Получение ширины объекта.
     */
    public function getWidth()
    {
        $this->load();
        
        return $this->get(self::FIELD_WIDTH);
    }
    
    
    /**
     * Получение высоты объекта.
     */
    public function getHeight()
    {
        $this->load();
        
        return $this->get(self::FIELD_HEIGHT);
    }
    
    
    /**
     * Получение ID цвета.
     */
    public function getColorID()
    {
        $this->load();
        
        return $this->get(self::FIELD_COLOR);
    }
    
    
    
    /**
     * Получение ID правового режима.
     */
    public function getLegalID()
    {
        $this->load();
        
        return $this->get(self::FIELD_LEGAL);
    }
    
    
    /**
     * Получение ID жанра.
     */
    public function getGenreID()
    {
        $this->load();
        
		return $this->get(self::FIELD_GENRE);
    }

	
	/**
	 * Получение раздела.
	 */
	public function getCollectionID()
	{
        $this->load();
        
		return $this->get(self::FIELD_COLLECTION);
	}
   
    
    /**
	 * Получение раздела.
	 */
	public function getCollection()
	{
		return (new Collection($this->getCollectionID()));
	}
    
    
    public function getProvenance()
    {
        $this->load();
        
        return $this->get(self::FIELD_PROVENANCE_SFX . CURRENT_LANG_UP);
    }
    
    public function getModel()
    {
        $this->load();
        
        return $this->get(self::FIELD_MODEL_SFX . CURRENT_LANG_UP);
    }
    
    public function getRestoration()
    {
        $this->load();
        
        return $this->get(self::FIELD_RESTORATION_SFX . CURRENT_LANG_UP);
    }
    
    public function getSketches()
    {
        $this->load();
        
        return $this->get(self::FIELD_SKETCHES_SFX . CURRENT_LANG_UP);
    }
    
    public function getTechnical()
    {
        $this->load();
        
        return $this->get(self::FIELD_TECHNICAL_SFX . CURRENT_LANG_UP);
    }
    
    public function getCustomer()
    {
        $this->load();
        
        return $this->get(self::FIELD_CUSTOMER_SFX . CURRENT_LANG_UP);
    }
    
    public function getOther()
    {
        $this->load();
        
        return $this->get(self::FIELD_OTHER_SFX . CURRENT_LANG_UP);
    }
    
    
    public function isModerate()
    {
        $this->load();
        
        return $this->get(self::FIELD_MODERATE);
    }
    
    public function getModerateTime()
    {
        $this->load();
        
        return $this->get(self::FIELD_MODERATE_TIME);
    }
    
    public function getModerateText()
    {
        $this->load();
        
        return $this->get(self::FIELD_MODERATE_TEXT);
    }
    
    
    
    
    /**
     * Получение информации об изображении.
     */
    public function getFileInfo()
    {
        $filepath = $_SERVER['DOCUMENT_ROOT'] . $this->getFullImageSrc();
        
        if (empty($this->fileinfo)) {
            $sizes = getimagesize($filepath);
            
            $this->fileinfo['PATH'] = pathinfo($filepath);
            $this->fileinfo['DIMS'] = array(
                'WIDTH'    => $sizes[0],
                'HEIGHT'   => $sizes[1],
                'BITS'     => $sizes['bits'],
                'CHANELLS' => $sizes['channels'],
                'MIME'     => $sizes['mime'],
            );
            $this->fileinfo['SIZE'] = filesize($filepath);
        }
        return $this->fileinfo;
    }
    
    
    /**
     * Получение расширения файла.
     */
    public function getFileExtension()
    {
        $fileinfo = $this->getFileInfo();
        
        return $fileinfo['PATH']['extension'];
    }
    
    
    /**
     * Получение размера файла изображения.
     */
    public function getFileSize()
    {
        $fileinfo = $this->getFileInfo();
        
        return ($fileinfo['SIZE'] / BYTES_IN_MEGABYTE);
    }
    
    
    /**
     * Получение ширины изображения.
     */
    public function getImageWidth()
    {
        $fileinfo = $this->getFileInfo();
        
        return $fileinfo['DIMS']['WIDTH'];
    }
    
    
    /**
     * Получение высоты изображения.
     */
    public function getImageHeight()
    {
        $fileinfo = $this->getFileInfo();
        
        return $fileinfo['DIMS']['HEIGHT'];
    }
    
    
    
    /**
     * Поучение файла.
     */
    public function getFile()
    {
        $this->load();
        
		return $this->get(self::FIELD_FILE);
    }
    
    
    /**
     * Поучение файла превью.
     */
    public function getFilePreview()
    {
        $this->load();
        
		return $this->get(self::FIELD_PREVIEW_FILE);
    }
    
    
    
    /**
     * Поучение файла превью с водяным знаком.
     */
    public function getFilePreviewWM()
    {
        $this->load();
        
		return $this->get(self::FIELD_PREVIEW_FILE_WATERMARK);
    }
    
    
    /**
     * Поучение файла малого превью.
     */
    public function getFileSmallPreview()
    {
        $this->load();
        
		return $this->get(self::FIELD_SMALL_FILE);
    }
    
    
    
    /**
     * Поучение файла малого превью с водяным знаком.
     */
    public function getFileSmallPreviewWM()
    {
        $this->load();
        
		return $this->get(self::FIELD_SMALL_FILE_WATERMARK);
    }
    
    
    /**
	 * Получение полного изображения.
	 */
	public function getFullImageSrc()
	{
		$this->load();
        
        $source = \CFile::getPath($this->getFile());
        
        return $source;
	}
    
	
	/**
	 * Получение изображения для предпросмотра.
	 */
	public function getPreviewImageSrc()
	{
		$this->load();
        
        $source = \CFile::getPath($this->getFilePreview());
        
        return $source;
	}
	
	
	/**
	 * Получение изображения для предпросмотра.
	 */
	public function getPreviewImageWMSrc()
	{
		$this->load();
        
        $source = \CFile::getPath($this->getFilePreviewWM());
        
        return $source;
	}
	
    
    /**
	 * Получение изображения для предпросмотра.
	 */
	public function getSmallPreviewImageSrc()
	{
		$this->load();
        
        if ($this->getFileSmallPreview()) {
            $source = \CFile::getPath($this->getFileSmallPreview());
        } else {
            $source = SITE_TEMPLATE_PATH . '/images/no-image.jpg';
        }
        
        return $source;
	}
	
	
	/**
	 * Получение изображения для предпросмотра.
	 */
	public function getSmallPreviewImageWMSrc()
	{
		$this->load();
        
        $source = \CFile::getPath($this->getFileSmallPreviewWM());
        
        return $source;
	}
    
    
    /**
     * Получение ссылки на карточку.
     */
    public function getDetailURL()
    {
        $this->load();
        
        return ('/collections/' . $this->getID() . '/');
    }
    
	
	/**
	 * Получение ссылки на скачаивание полного изображения.
	 */
	public function getDownloadLink()
	{
        $link = '/download/' . $this->getDownloadToken(\CUser::getID()) . '/';
        
		return $link;
	}
    
    
    public function isExpireLastDownload()
    {
        
    }
	
    
	/**
	 * Получение токена на скачивание.
	 */
	public function getDownloadToken($userID, $ttl = 0)
	{
        $data = array(
            'image'  => $this->getID(),
            'user'   => $userID,
            'time'   => time(),
        );
        
        // 'nbf'   => time() - 1000, // время начала использования
        // 'exp'   => time() + 3600 * 1000, // время окончания использования
        
        if ($ttl > 0) {
            $data['exp'] = time() + $ttl;
        } else {
            $data['exp'] = time() + self::DOWNLOAD_EXPIRE;
        }
        
        // Генерация токена.
        $token = JWT::encode($data, JWT_KEY);
        
		// Событие "Выдача токена на скачивание".
		$event = new \Bitrix\Main\Event(
            MODULE_GLYF_OSCAR_ID,
            'OnPictureGetDownloadToken', 
            array('SELF' => $this, 'USER_ID' => $userID, 'DATA' => $data, 'TOKEN' => $token)
        );
		$event->send();
        
        return $token;
	}
    
    
    
    /**
     * Создание изображений для предпросмотра.
     */
    public static function makePreviewFiles($filepath)
    {
        $filepath = (string) $filepath;
        
        if (!is_readable($filepath)) {
            return false;
        }
        
        $filenames = array(
            'PREVIEW' => tempnam('/tmp', 'preview').'.jpg',
            'PREVIEW_WM' => tempnam('/tmp', 'preview').'.jpg',
            'SMALL_PREVIEW' => tempnam('/tmp', 'preview').'.jpg',
            //'SMALL_PREVIEW_WM' => tempnam('/tmp', 'preview').'.jpg',
        );
        
        // Среднее изображение без знака.
        self::makePreview(
            $filepath,
            $filenames['PREVIEW'],
            self::IMAGE_PREVIEW_WIDTH,
            self::IMAGE_PREVIEW_HEIGHT,
            false
        );
        
        // Малое изображение без знака.
        self::makePreview(
            $filepath,
            $filenames['SMALL_PREVIEW'],
            self::IMAGE_SMALL_WIDTH,
            self::IMAGE_SMALL_HEIGHT,
            false
        );
        
        
        // Среднее изображение со знаком.
        self::makePreview(
            $filepath,
            $filenames['PREVIEW_WM'],
            self::IMAGE_PREVIEW_WIDTH,
            self::IMAGE_PREVIEW_HEIGHT,
            true
        );
        
        // Малое изображение со знаком.
        /*
        self::makePreview(
            $filepath,
            $filenames['SMALL_PREVIEW_WM'],
            self::IMAGE_SMALL_WIDTH,
            self::IMAGE_SMALL_HEIGHT,
            true
        );
        */
        
        return $filenames;
    }
    
    
    /**
     * Создание изображения для предпросмотра.
     */
    protected static function makePreview($filepath, $path, $width, $height, $watermark = false)
    {
        $filepath  = (string) $filepath;
        $watermark = (string) $watermark;
        
        if (!is_readable($filepath)) {
            return false;
        }
        
        // Изображение.
        $image = new \Imagick($filepath);
        
        // Размеры исходного изображения.
        $iwidth  = $image->getImageWidth();
        $iheight = $image->getImageHeight();
        
        // Максимальный размер поодной стороне.
        $maxsize = ($iwidth > $iheight) ? ('width') : ('height');
        
        
        // Масштабирование.
        if ($maxsize == 'width') {
            $image->scaleImage($width, 0);
        } else {
            $image->scaleImage(0, $height);
        }
        
        
        // Наложение водного знака.
        if ($watermark) {
            // Новые размеры исходного изображения.
            $nwidth  = $image->getImageWidth();
            $nheight = $image->getImageHeight();
            
            $wmimage = new \Imagick($_SERVER['DOCUMENT_ROOT'] . self::IMAGE_WATERMARK_PATH);
            $image->compositeImage($wmimage, \Imagick::COMPOSITE_DEFAULT, $nwidth / 2 - self::IMAGE_WATERMARK_WIDTH / 2, $nheight / 2 - self::IMAGE_WATERMARK_HEIGHT / 2);
        }
        
        $image->writeImage($path);
        $image->destroy();
    }
    
    
    
    /**
     * Получение количества прсомотров.
     */
    public function getStatisticViewsCount()
    {
        $this->load();
        
        return $this->get(self::FIELD_STAT_VIEWS);
        
        /*
        $result = \Glyf\Oscar\Statistic\View::getList(array(
            'select' => array('ID'), 
            'filter' => array(\Glyf\Oscar\Statistic\View::FIELD_ELEMENT_ID => $this->getID())
        ), false);
        
        return $result->getSelectedRowsCount();
        */
    }
    
    
    /**
     * Получение количества продаж.
     */
    public function getStatisticLoadsCount()
    {
        $this->load();
        
        return $this->get(self::FIELD_STAT_LOADS);
        
        /*
        $result = \Glyf\Oscar\Statistic\Download::getList(array(
            'select' => array('ID'), 
            'filter' => array(\Glyf\Oscar\Statistic\Download::FIELD_ELEMENT_ID => $this->getID())
        ), false);
        
        return $result->getSelectedRowsCount();
        */
    }
    
    
    /**
     * Получение количества продаж.
     */
    public function getStatisticSalesCount()
    {
        
        $this->load();
        
        return $this->get(self::FIELD_STAT_SALES);
        
        /*
        $result = \Glyf\Oscar\Statistic\Sale::getList(array(
            'select' => array('ID'), 
            'filter' => array(\Glyf\Oscar\Statistic\Sale::FIELD_ELEMENT_ID => $this->getID())
        ), false);
        
        return $result->getSelectedRowsCount();
        */
    }
    
    
    public function recordStatisticView($uid = null)
    {
        $user = new \Glyf\Oscar\User($uid);
        
        $view = new \Glyf\Oscar\Statistic\View();
        $view->add(array(
            \Glyf\Oscar\Statistic\View::FIELD_TIME        => date('d.m.Y H:i:s'),
            \Glyf\Oscar\Statistic\View::FIELD_TYPE        => 'PICTURE',
            \Glyf\Oscar\Statistic\View::FIELD_IP          => $_SERVER['REMOTE_ADDR'],
            \Glyf\Oscar\Statistic\View::FIELD_USER_ID     => $user->getID(),
            \Glyf\Oscar\Statistic\View::FIELD_UPLOADER_ID => $this->getUserID(),
            \Glyf\Oscar\Statistic\View::FIELD_ELEMENT_ID  => $this->getID(),
        ));
        
        $this->update(array(self::FIELD_STAT_VIEWS => $this->getStatisticViewsCount() + 1));
    }
    
    
    public function recordStatisticLoad($uid = null)
    {
        $user = new \Glyf\Oscar\User($uid);
        
        $load = new \Glyf\Oscar\Statistic\Download();
        $load->add(array(
            \Glyf\Oscar\Statistic\Download::FIELD_TIME        => date('d.m.Y H:i:s'),
            \Glyf\Oscar\Statistic\Download::FIELD_USER_ID     => $user->getID(),
            \Glyf\Oscar\Statistic\Download::FIELD_UPLOADER_ID => $this->getUserID(),
            \Glyf\Oscar\Statistic\Download::FIELD_ELEMENT_ID  => $this->getID(),
            \Glyf\Oscar\Statistic\Download::FIELD_BUYED       => $this->isBuyedByUser($user->getID())
        ));
        
        $this->update(array(self::FIELD_STAT_LOADS => $this->getStatisticLoadsCount() + 1));
    }
    
    
    public function recordStatisticSale($price, $oid, $lid, $uid = null)
    {
        $user = new \Glyf\Oscar\User($uid);
        
        $license = new \Glyf\Oscar\License($lid);
        $license = $license->getLicenseRoot();
        
        $rid = 0;
        if (!empty($license)) {
            $rid = $license->getID();
        }
        
        $sale = new \Glyf\Oscar\Statistic\Sale();
        $sale->add(array(
            \Glyf\Oscar\Statistic\Sale::FIELD_TIME          => date('d.m.Y H:i:s'),
            \Glyf\Oscar\Statistic\Sale::FIELD_USER_ID       => $user->getID(),
            \Glyf\Oscar\Statistic\Sale::FIELD_UPLOADER_ID   => $this->getUserID(),
            \Glyf\Oscar\Statistic\Sale::FIELD_ELEMENT_ID    => $this->getID(),
            \Glyf\Oscar\Statistic\Sale::FIELD_ORDER_ID      => (int) $oid,
            \Glyf\Oscar\Statistic\Sale::FIELD_LICENSE_ID    => (int) $lid,
            \Glyf\Oscar\Statistic\Sale::FIELD_LICENSE_ROOT  => (int) $rid,
            \Glyf\Oscar\Statistic\Sale::FIELD_PRICE         => (float) $price,
        ));
        
        $this->update(array(self::FIELD_STAT_SALES => $this->getStatisticSalesCount() + 1));
    }
    
    
    
    /**
     * Проверка принадлежности пользователю.
     */
    public function isBelongsToUser($uid = null)
    {
        if (empty($uid)) {
            $uid = \CUser::getID();
        }
        $uid = (int) $uid;
        
        return ($this->getUserID() == $uid);
    }
    
    
    /**
     * Проверка покупки пользователем.
     */
    public function isBuyedByUser($uid = null)
    {
        if (empty($uid)) {
            $uid = \CUser::getID();
        }
        $uid = (int) $uid;
        
        $user = new \Glyf\Oscar\User($uid);
        
        $result = \Glyf\Oscar\Statistic\Sale::getList(array(
            'filter' => array(
                \Glyf\Oscar\Statistic\Sale::FIELD_ELEMENT_ID => $this->getID(),
                \Glyf\Oscar\Statistic\Sale::FIELD_USER_ID    => $user->getID(),
            ),
            'limit' => 1
        ), false);
        
        if ($result && $result->getSelectedRowsCount() > 0) {
            return true;
        }
        return false;
    }
    
    
    /**
     * Наложение водного знака на изображение.
     */
    public static function imposeWaterMark()
    {
        
    }
    
    
    /**
     * Получение списка просмотров и продаж.
     */
    public static function getStats($params, $asobjects = true)
    {
        $connection = \Bitrix\Main\Application::getConnection();
        
        // Запрос.
        $sql = "
            SELECT p.*, COUNT(DISTINCT v.ID) as `VIEWS`, COUNT(DISTINCT s.ID) as `SALES`
            FROM `g_pictures` AS `p`
            INNER JOIN `g_statistic_views` AS `v` ON (v.UF_ELEMENT_ID = p.ID)
            INNER JOIN `g_statistic_sales` AS `s` ON (s.UF_ELEMENT_ID = p.ID)
        ";
        
        if (!empty($params['filter'])) {
            $wheres = array();
            foreach ($params['filter'] as $key => $val) {
                $op = substr($key, 0, 2);
                
                switch ($op) {
                    case ('<='):
                    case ('>='):
                        $key = substr($key, 2);
                        break;
                    
                    case ('~='):
                        $op  = 'LIKE';
                        $key = substr($key, 2);
                        break;
                    
                    default:
                        $op = '=';
                        break;
                }
                
                if (is_array($val)) {
                    $wheres []= $key . " IN ('" . implode("', '", $val) . "')";
                } else {
                    $wheres []= $key . " " . $op . " '" . $val . "'";
                }
            }
            $sql .= " WHERE " . implode(' AND ', $wheres);
        }
        
        $sql .= " GROUP BY (p.ID) ";
        
        if (!empty($params['order'])) {
            $orders = array();
            foreach ($params['order'] as $key => $val) {
                $orders []= $key . " " . $val;
            }
            $sql .= " ORDER BY " . implode(', ', $orders);
        }
        
        if (!empty($params['limit'])) {
            $sql .= " LIMIT " . intval($params['limit']);
            
            if (!empty($params['offset']) && $params['offset'] > 0) {
                $sql .= " OFFSET " . intval($params['offset']);
            }
        }
        
        // Запрос.
        $result = $connection->query($sql);
        
        if (!$asobjects) {
            return $result;
        }
        
        $items = array();
        while ($item = $result->fetch()) {
            $picture = new self($item['ID'], $item);
            $picture->views = (int) $item['VIEWS'];
            $picture->sales = (int) $item['SALES'];
            
            $items[$item['ID']] = $picture;
        }
        
        return $items;
    }
    
    
    public function getStatViews()
    {
        return $this->views;
    }
    
    
    public function getStatSales()
    {
        return $this->sales;
    }
    
}