<?php

namespace Glyf\Core\System;

\Bitrix\Main\Loader::includeModule('iblock');

class IBlockSectionModel extends Model
{
	protected static $iblockID;
	
	
	/**
	 * Получение ID инфоблока рзделов.
	 */
	public static function getIBlockID()
	{
		return static::$iblockID;
	}
	
	
	/**
	 * Загрузка данных элемента.
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
    
    
    public function add($data)
    {
        
    }
	
	
	public function update($data)
    {
        
    }
	
		
	public function delete()
    {
        return \CIBlockSection::Delete($this->getID());
    }
	
	
	public function existDB()
    {
        $result = \CIBlockSection::GetByID($this->getID())->Fetch();
		
		return ($result);
    }
	
	
	public static function getList($params, $object = true, $key = 'ID')
    {
        $result = self::queryByParams($params);

        if (!$object) {
            return $result;
        }
        $items = array();
        while ($item = $result->Fetch()) {
            $items[$item[$key]] = new static($item['ID']);
        }
        return $items;
    }
    
    
    /**
     * @param array $params
     * @return \CIBlockResult|int
     * @throws \Exception
     * @throws \Bitrix\Main\LoaderException
     */
    private static function queryByParams($params = array())
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            throw new \Exception('Module IBLOCK is not installed.');
        }
		
        $order  = $params['order'] ?: array();
        $filter = array_merge($params['filter'] ?: array(), array('IBLOCK_ID' => self::getIBlockID()));
        $select = array_merge($params['select'] ?: array(), array('ID'));
		
        return (\CIBlockSection::GetList($order, $filter, $select));
    }
    
    
    /**
     * Получение пути до корневого раздела.
     */
    public function getNavChain($select = array())
    {
        $result = \CIBlockSection::GetNavChain(self::getIBlockID(), $this->getID(), $select);
        
        $items = array();
        
        while ($item = $result->fetch()) {
            $items []= $item;
        }
        return $items;
    }
    
    
    /**
     * Получение ID всех подразделов.
     */
    public function getSubsectionIDs()
    {
        $result = \CIBlockSection::GetList(
            array('LEFT_MARGIN' => 'ASC'),
            array(
                'IBLOCK_ID'  => self::getIBlockID(),
                'SECTION_ID' => $this->getID()
            ),
            array('ID')
        );
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= $item['ID'];
        }
        return $items;
    }
    
    
    
    /**
     * Получение ID всех подразделов.
     */
    public static function getFullSubsectionIDs($sids)
    {
        $ids = array_map('intval', (array) $sids);
        
        $result = \CIBlockSection::GetList(
            array('LEFT_MARGIN' => 'ASC'),
            array(
                'IBLOCK_ID'  => self::getIBlockID(),
                'SECTION_ID' => $ids
            ),
            array('ID')
        );
        
        while ($item = $result->fetch()) {
            $ids []= $item['ID'];
        }
        return $ids;
    }
}