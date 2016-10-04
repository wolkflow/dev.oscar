<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class Picture extends HLBlockModel
{
	static protected $hlblockID = 4;
	
	// Список полей.
	const FIELD_ID              = 'ID';
	const FIELD_LANG_TITLE_SFX  = 'UF_LANG_TITLE_';
	const FIELD_LANG_TITLE_RU   = 'UF_LANG_TITLE_RU';
	const FIELD_LANG_TITLE_EN   = 'UF_LANG_TITLE_EN';
	const FIELD_AUTHOR          = 'UF_AUTHOR';
	const FIELD_HOLDER          = 'UF_HOLDER';
	const FIELD_FILE            = 'UF_FILE';
	
	const FIELD_KEYWORDS        = 'UF_KEYWORDS';
	const FIELD_SECTION         = 'UF_SECTION';
	const FIELD_GENRE           = 'UF_GENRE';
	const FIELD_PLACE           = 'UF_PLACE';
	const FIELD_WIDTH           = 'UF_WIDTH';
	const FIELD_HEIGHT          = 'UF_HEIGHT';
	const FIELD_COLOR           = 'UF_COLOR';
	const FIELD_LEGAL_REGIME    = 'UF_LEGAL_REGIME';
	
	const FIELD_UPLOAD_TIME     = 'UF_UPLOAD_TIME';
	const FIELD_MODERATION      = 'UF_MODERATION';
	const FIELD_MODERATION_TIME = 'UF_MODERATION_TIME';
	
	
	/**
	 * Получение названия изображения.
	 */
	public function getTitle()
	{
		return $this->get(self::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP);
	}
	
	
	/**
	 * Получение ID автора.
	 */
	public function getAuthorID()
	{
		return $this->get(self::FIELD_AUTHOR);
	}
	
	
	/**
	 * Получение ID правообладателя.
	 */
	public function getHolderID()
	{
		return $this->get(self::FIELD_HOLDER);
	}
	
	
	/**
	 * Получение ключевых слов.
	 */
	public function getKeywords()
	{
		return $this->get(self::FIELD_KEYWORDS);
	}
	
	
	/**
	 * Получение ключевых слов.
	 */
	public function getKeywordsSplit()
	{
		return array_map('trim', explode(',', $this->getKeywords());
	}
	
	
	/**
	 * Получение раздела.
	 */
	public function getSectionID()
	{
		return $this->get(self::FIELD_SECTION);
	}
	
	
	/**
	 * Получение изображения для предпросмотра.
	 */
	public function getPreviewImageSrc($width = 1000, $height = 1000)
	{
		
	}
	
	
	/**
	 * Получение полного изображения.
	 */
	public function getFullImageSrc()
	{
		
	}
	
	
	/**
	 * Получение ссылки на скачаивание полного изображения.
	 */
	public function getFullImageLink()
	{
		
	}
	
	
	/**
	 * Получение токена на скачивание.
	 */
	public function getDownloadToken($user_id, $ttl)
	{
		// Событие "Выдача токена на скачивание".
		$event = new \Bitrix\Main\Event($moduleID, 'OnPictureGetDownloadToken', array('SELF' => $this, 'USER_ID' => $user_id));
		$event->send();
	}
}