<?php

namespace Glyf\Oscar;

// JWT.
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/JWT.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/BeforeValidException.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/ExpiredException.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/SignatureInvalidException.php');


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
	
    // Дата создания.
	const FIELD_PERIOD_FROM     = 'UF_PERIOD_FROM';
    const FIELD_PERIOD_TO       = 'UF_PERIOD_TO';
    const FIELD_IS_YEAR_FROM    = 'UF_IS_YEAR_FROM';
    const FIELD_IS_YEAR_TO      = 'UF_IS_YEAR_TO';
    //const FIELD_ERA_FROM        = 'UF_ERA_FROM';
    //const FIELD_ERA_TO          = 'UF_ERA_TO';
	
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
	
    
    
    const PROP_LEGAL_FULL_ID = 30;
    const PROP_LEGAL_NOCOMMERCIAL_ID = 31;
    
    const PROP_TIME_BC = 'BC'; // Before Christ
    const PROP_TIME_AD = 'AD'; // Anno Domini
    
    
    // Размеры дял превью.
    const IMAGE_WATERMARK_PATH   = '/images/img/watermark.png';
    const IMAGE_WATERMARK_WIDTH  = 66;
    const IMAGE_WATERMARK_HEIGHT = 45;
    const IMAGE_PREVIEW_WIDTH    = 1000;
    const IMAGE_PREVIEW_HEIGHT   = 1000;
    const IMAGE_SMALL_WIDTH      = 545;
    const IMAGE_SMALL_HEIGHT     = 360;
    
    
    
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
	 * Получение ID автора.
	 */
	public function getAuthorID()
	{
        $this->load();
        
		return $this->get(self::FIELD_AUTHOR);
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
        
		return $this->get(self::FIELD_HOLDER);
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
	 * Получение ключевых слов.
	 
	public function getKeywordsSplit()
	{
		return array_map('trim', explode(',', $this->getKeywords()));
	}
	*/
	
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
        
        $source = \CFile::getPath($this->getFileSmallPreview());
        
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
	public function getFullImageLink()
	{
        $link = '/images/' . $this->getDownloadToken(\CUser::getID()) . '/';
        
		return $link;
	}
	
    
	/**
	 * Получение токена на скачивание.
	 */
	public function getDownloadToken($userID, $ttl = 0)
	{
        $data = array(
            'image' => $this->getID(),
            'user'  => $userID,
            //'nbf'   => time() - 1000, // время начала использования
           // 'exp'   => time() + 3600 * 1000, // время окончания использования
        );
        
        if ($ttl > 0) {
            $data['exp'] = time() + $ttl;
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
            'SMALL_PREVIEW_WM' => tempnam('/tmp', 'preview').'.jpg',
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
        self::makePreview(
            $filepath,
            $filenames['SMALL_PREVIEW_WM'],
            self::IMAGE_SMALL_WIDTH,
            self::IMAGE_SMALL_HEIGHT,
            true
        );
        
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
     * Наложение водного знака на изображение.
     */
    public static function imposeWaterMark()
    {
        
    }
}