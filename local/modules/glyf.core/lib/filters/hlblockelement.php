<?php

namespace Glyf\Core\Filters;

use CIBlockElement;
use Glyf\Core\System\HLBlockModel;

\Bitrix\Main\Loader::includeModule('highloadblock');

class HLBlockElement extends Base
{
    protected static $hlblockID;
    
    
    
    public function __construct()
	{
		$this->params = array('order' => array(), 'filter' => array());
	}
    
    
    public function setLimit($limit)
	{
		$limit = (int) $limit;
		if ($limit <= 0) {
			return false;
		}
        $this->params['limit'] = $limit;
    }
    
    
    
    public function setOffset($offset)
    {
		$offset = (int) $offset;
        if ($offset <= 0) {
            return false;
        }
        $this->params['offset'] = $offset;
    }
    
    
    /**
	 * Выполнение запроса.
	 */
	public function execute()
	{
		$this->preset();
		$this->process();
        
        $entity = static::getEntityClassName();
        
		$this->result = $entity::GetList($this->params);
	}
    
    
    /**
	 * Количество записей.
	 */
	public function getCount() 
	{
		if ($this->result) {
			return (int) $this->result->getSelectedRowsCount();
		}
		return null;
	}
    
    
    public function process()
	{
		foreach ($this->params['filter'] as $filter => $value) {
            if (is_array($value) && empty($value)) {
                $this->reset();
                break;
            }
		}
	}
    
    
    /**
     * Возвращает имя класса.
     *
     * @return string
     */
    protected static function getEntityClassName()
    {
    	$hldata    = \Bitrix\Highloadblock\HighloadBlockTable::getById(static::$hlblockID)->Fetch();
    	$hlentity  = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    	$classname = $hlentity->getDataClass();
    	
        return $classname;
    }
}