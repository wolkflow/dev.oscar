<?php

namespace Glyf\Core\Helpers;

class IBlock
{
	protected static $iblocks;
	
	
	/**
     * Получение инфоблока по коду.
     */
    public static function getByCode($code)
    {
        $code = (string) $code;
        
        if (!isset(self::$iblocks[$code])) {
    		if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    			return;
    		}
    		$db = \CIBlock::GetList(array(), array('CODE' => strval($code)), true);
    		if ($iblock = $db->Fetch()) {
    			self::$iblocks[$code] = $iblock;
    		}
        }
        return self::$iblocks[$code];
    }
	
    
    /**
     * Получение ID по коду.
     */
	public static function getIDByCode($code)
	{
		if (!\Bitrix\Main\Loader::includeModule('iblock')) {
			return;
		}
		$iblock = self::getByCode($code);
		
		return intval($iblock['ID']);
	}
	
	
	/**
     * Получение кода по ID.
     */
	public static function getCodeById($id)
	{
		if (!\Bitrix\Main\Loader::includeModule('iblock')) {
			return;
		}
		$iblock = \CIBlock::getByID($id)->Fetch();
		
		return strval($iblock['CODE']);
	}
}