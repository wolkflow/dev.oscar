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
	static protected $hlblockID = 4;
	
    
	// Идентификатор.
	const FIELD_ID              = 'ID';
    
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
    const FIELD_PLACE_CAND      = 'UF_PLACE_CAND';
    
    // Раздел коллекции.
    const FIELD_COLLECTION      = 'UF_COLLECTION';
	
    // Дата создания.
	const FIELD_PERIOD_FROM     = 'UF_PERIOD_FROM';
    const FIELD_PERIOD_TO       = 'UF_PERIOD_TO';
    const FIELD_IS_YEAR_FROM    = 'UF_IS_YEAR_FROM';
    const FIELD_IS_YEAR_TO      = 'UF_IS_YEAR_TO';
	
    // Свойства.
	const FIELD_GENRE           = 'UF_GENRE';
	const FIELD_WIDTH           = 'UF_WIDTH';
	const FIELD_HEIGHT          = 'UF_HEIGHT';
	const FIELD_COLOR           = 'UF_COLOR';
	const FIELD_LEGAL           = 'UF_LEGAL';
    const FIELD_FOLDER          = 'UF_FOLDER';
    
    // Служебные данные.
    const FIELD_FILE            = 'UF_FILE';
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
    const IMAGE_PREVIEW_WIDTH  = 1000;
    const IMAGE_PREVIEW_HEIGHT = 1000;
    
	
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
	 * Получение ID правообладателя.
	 */
	public function getHolderID()
	{
        $this->load();
        
		return $this->get(self::FIELD_HOLDER);
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
	 * Получение ключевых слов.
	 */
	public function getTechniqueID()
	{
        $this->load();
        
		return $this->get(self::FIELD_TECHNIQUE);
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
     * Поучение файла.
     */
    public function getFile()
    {
        $this->load();
        
		return $this->get(self::FIELD_FILE);
    }
    
	
	/**
	 * Получение изображения для предпросмотра.
	 */
	public function getPreviewImageSrc($width = 1000, $height = 1000)
	{
		// TODO: make preview image;
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
        $link = '/iamges/' . $this->getDownloadToken(\CUser::getID()) . '/';
        
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
     * Наложение водного знака на изображение.
     */
    public static function imposeWaterMark()
    {
        
    }
}