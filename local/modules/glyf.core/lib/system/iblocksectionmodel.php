<?php

namespace Glyf\Core\System;

\Bitrix\Main\Loader::includeModule('iblock');

class IBlockSectionModel extends Model
{
	protected static $iblockID;
	
	
	/**
	 * ��������� ID ��������� �������.
	 */
	public static function getIBlockID()
	{
		return self::$iblockID;
	}
	
	
	/**
	 * �������� ������ ��������.
	 *
	 * @param bool $force
	 * @return array
	 */
	public function load($force = false)
	{
		if (empty($this->data) || $force) {
			$element = \CIBlockSection::getList(
				array(), 
				array('IBLOCK_ID' => self::getIBlockID(), 'ID' => $this->getID()), 
				false, 
				array('UF_LANG_TITLE_RU', 'UF_LANG_TITLE_EN')
			)->getNext();
			
			if ($element) {
				$this->data = $element;
			}
		}
		return $this->data;
	}
}