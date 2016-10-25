<?php

namespace Glyf\Core\Filters;

use CIBlockElement;

\Bitrix\Main\Loader::includeModule('iblock');

class IBlockElement extends Base
{
    
    public function __construct()
	{
		$this->params = array('order' => array(), 'filter' => array(), 'group' => false, 'nav' => false, 'select' => array());
	}
    
    
    public function setLimit($limit)
	{
		$limit = (int) $limit;
		if ($limit <= 0) {
			return false;
		}
        $this->params['nav']['nTopCount'] = $limit;
    }
    
    
    public function setPageNum($number)
    {
        $number = (int) $number;
		if ($number <= 0) {
			return false;
		}
        $this->params['nav']['iNumPage'] = $number;
    }
    
    
    public function setPageSize($size)
    {
        $size = (int) $size;
		if ($size <= 0) {
			return false;
		}
        $this->params['nav']['size'] = $size;
    }
	
	
	public function setOffset($offset)
    {
		$offset = (int) $offset;
		
        if ($offset <= 0) {
            return false;
        }
		
        if (empty($this->params['nav']['nPageSize'])) {
            $this->setPageSize($offset);
            $this->setPageNum(2);
        } else {
            $this->setPageNum(floor($offset / $this->params['nav']['nPageSize']) + 1);
        }
    }
    
    
    public function setNav($nav)
	{
		$this->params['nav'] = $nav;
	}
	
	
	public function getNav()
	{
		return $this->params['nav'];
	}
    
    
    /**
	 * Выполнение запроса.
	 */
	public function execute()
	{
		$this->preset();
		$this->process();
		
		$this->result = CIBlockElement::GetList($this->params['order'], $this->params['filter'], $this->params['group'], $this->params['nav'], $this->params['select']);
	}
    
    
    /**
	 * Количество записей.
	 */
	public function getCount() 
	{
		if ($this->result) {
			return (int) $this->result->SelectedRowsCount();
		}
		return null;
	}
    
    
    public function process()
	{
		foreach ($this->params['filter'] as $filter => $value) {
			if (strpos($filter, 'PROPERTY') !== false) {
				if (is_array($value) && empty($value)) {
					$this->reset();
					break;
				}
			}
		}
	}
}