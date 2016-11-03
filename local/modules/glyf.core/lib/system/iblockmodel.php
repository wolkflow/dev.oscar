<?php

namespace Glyf\Core\System;

\Bitrix\Main\Loader::includeModule('iblock');

class IBlockModel extends Model
{
	
	/**
	 * Загрузка данных элемента.
	 *
	 * @param bool $force
	 * @return array
	 */
	public function load($force = false)
	{
		if (empty($this->data) || $force) {
			$element = \CIBlockElement::GetByID($this->getID())->GetNextElement();
			
			if ($element) {
				$this->data = $element->getFields();
				$this->data['PROPS'] = $element->getProperties();
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
		$element = new \CIBlockElement();
		
		if ($id = $element->Add($data)) {
			$this->id = $id;
			return $this->getID();
		} else {
			throw new \Exception($element->LAST_ERROR);
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
		
	}
	
	
	/**
	 * Удаление элемента
	 *
	 * @retrun bool
	 */
	public function delete()
	{
		return \CIBlockElement::Delete($this->getID());
	}
	
	
	/**
	 * Проверка существования элемента в БД.
	 *
	 * @return bool
	 */
	public function existDB()
	{
		$result = \CIBlockElement::GetByID($this->getID())->Fetch();
		
		return ($result);
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
        $filter = array_merge($params['filter'] ?: array(), array('IBLOCK_ID' => static::IBLOCK_ID));
        $group  = $params['group'] ?: false;
        $limit  = $params['limit'] ? array('nTopCount' => $params['limit']) : false;
        $select = array_merge($params['select'] ?: array(), array('ID'));
		
        return (\CIBlockElement::GetList($order, $filter, $group, $limit, $select));
    }
}