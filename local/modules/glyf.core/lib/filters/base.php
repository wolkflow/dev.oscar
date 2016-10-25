<?php

namespace Glyf\Core\Filters;


/**
 * Класс фильтрации.
 */
class Base
{
	protected $params = array();
	protected $result = null;
	
	
	public function __construct()
	{
		$this->params = array();
	}
	
	
	public function setLimit($limit)
	{
    }
    
	
	public function setOffset($offset)
    {
    }
	
	
	public function setOrder($order)
	{
		$this->params['order'] = $order;
	}
	
	
	public function getOrder()
	{
		return $this->params['order'];
	}
	
	
	public function setFilter($filter)
	{
		$this->params['filter'] = $filter;
	}
	
	
	public function getFilter()
	{
		return $this->params['filter'];
	}
	
	
	public function setIDs($ids)
	{
		if (empty($this->params['filter']['ID'])) {
			$this->params['filter']['ID'] = (array) $ids;
		} else {
			$this->params['filter']['ID'] = array_intersect((array) $this->params['filter']['ID'], (array) $ids);
		}
	}
	
	
	public function reset()
	{
		$this->params['filter'] = array('ID' => 0);
	}
	
	
	/**
	 * Количество записей.
	 */
	public function getCount() 
	{
    }
	
	
	/**
	 * Получение результата выборки.
	 */
	public function getResult()
	{
		return $this->result;
	}
	
	
	public function preset()
	{
	}
	
    
	public function process()
	{
	}
}

