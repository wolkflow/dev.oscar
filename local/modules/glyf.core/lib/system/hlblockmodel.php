<?php

namespace Glyf\Core\System;

\Bitrix\Main\Loader::includeModule('highloadblock');

class HLBlockModel extends Model
{
	protected static $hlblockID;
    protected static $gateway;
	
    
	/**
     * Возвращает имя класса.
     *
     * @return string
     */
    public static function getEntityClassName()
    {
    	$hldata    = \Bitrix\Highloadblock\HighloadBlockTable::getById(static::$hlblockID)->Fetch();
    	$hlentity  = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    	$classname = $hlentity->getDataClass();
    	
        return $classname;
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
			$entity  = self::getEntityClassName();
			$element = $entity::GetByID($this->getID());
			
			if ($element) {
				$this->data = $element->fetch();
			}
		}
		return $this->data;
	}
	
	
	/**
	 * Добавление элемента.
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function add($data)
	{
        $classname = self::getEntityClassName();
		$element   = new $classname;
		$result    = $element->add($data);
		
		if ($result->isSuccess()) {
			$this->id = $result->getID();
			return $this->getID();
		} else {
			throw new \Exception(implode(', ', $result->getErrorMessages()));
		}
	}
	
	
	/**
	 * Редактирование элемента.
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function update($data)
	{
		$classname = self::getEntityClassName();
        $element   = new $classname;
		$result    = $element->update($this->getID(), $data);
		
		if ($result->isSuccess()) {
			return $this->getID();
		} else {
			throw new \Exception(implode(', ', $result->getErrorMessages()));
		}
	}
	
	
	/**
	 * Удаление элемента
	 *
	 * @retrun bool
	 */
	public function delete()
	{
		$element = self::getEntityClassName();
		$element::delete($this->getID());
        
        // Событие при удалении.
        $this->onDelete();
	}
	
	
	/**
	 * Проверка существования элемента в БД.
	 *
	 * @return bool
	 */
	public function existDB()
	{
		$entity = self::getEntityClassName();
		$result = $entity::GetByID($this->getID())->fetch();
		
		return $result;
	}
    
    
    /**
     * Событие на удаление.
     */
    protected function onDelete()
    {
        
    }
    
    
	
	/**
	 * Получение списка элементов.
	 *
	 * @param array $params
	 * @param bool $object
	 * @param string $key
	 * @return mixed
	 */
	public static function getList($params, $object = true, $key = 'ID')
	{
		$entity = self::getEntityClassName();
		$result = $entity::getList($params);
        
        if (!$object) {
            return $result;
        }
        $items = array();
        while ($item = $result->fetch()) {
            $items[$item[$key]] = new static($item['ID']);
        }
        return $items;
	}
    
    
    protected static function getEntityGateway()
    {
        if (!static::$gateway) {
            $classname = static::getEntityClassName();
            static::$gateway = new $classname;
        }
        return static::$gateway;
    }
}