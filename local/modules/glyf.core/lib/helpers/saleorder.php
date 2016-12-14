<?php

namespace Glyf\Core\Helpers;


class SaleOrder
{
    protected $id;
    protected $data;
    
    
    public function __construct($id)
    {
        $this->id = (int) $id;
    }
    
    
    public function getID()
    {
        return $this->id;
    }
    
    
    public function getData()
    {
        if (empty($this->data)) {
            $this->data = \CSaleOrder::GetByID($this->getID());
        }
        return $this->data;
    }
    
    
    public function getPrice()
    {
        $data = $this->getData();
        
        return (float) $data['PRICE'];
    }
    
    
    /**
     * Получение свойств заказа.
     */
	public function getProperties($key = 'CODE')
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		$result = \CSaleOrderPropsValue::GetList(array('SORT' => 'ASC'), array('ORDER_ID' => $this->getID()));
		$items  = array();
		while ($item = $result->Fetch()) {
			$items[$item[$key]] = $item;
		}
		return $items;
	}
	
	
    /**
     * Получение свойства заказа.
     */
	public function getProperty($code, $key = 'CODE')
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		$result = \CSaleOrderPropsValue::GetList(array('SORT' => 'ASC'), array('ORDER_ID' => $this->getID(), 'CODE' => $code));
		$items  = array();
		if ($item = $result->Fetch()) {
			return $item;
		}
		return;
	}
	
	
    /**
     * Сохранение свойства заказа.
     */
	public function saveProperty($code, $value)
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		if ($prop = \CSaleOrderProps::GetList(array(), array('CODE' => $code))->Fetch()) {
			if ($propval = \CSaleOrderPropsValue::GetList(array(), array('ORDER_ID' => $this->getID(), 'CODE' => $prop['CODE']))->Fetch()) {
				return \CSaleOrderPropsValue::Update($propval['ID'], array(
				   'NAME' 			=> $prop['NAME'],
				   'CODE' 			=> $prop['CODE'],
				   'ORDER_PROPS_ID' => $prop['ID'],
				   'ORDER_ID' 		=> $this->getID(),
				   'VALUE' 			=> $value,
				));
			} else {
				return \CSaleOrderPropsValue::Add(array(
				   'NAME' 			=> $prop['NAME'],
				   'CODE' 			=> $prop['CODE'],
				   'ORDER_PROPS_ID' => $prop['ID'],
				   'ORDER_ID' 		=> $this->getID(),
				   'VALUE' 			=> $value,
				));
			}
		}
	}
	
	
    /**
     * Получение корзин заказа.
     */
	public function getBaskets($withprops = true)
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		$result = \CSaleBasket::GetList(array('SORT' => 'ASC'), array('ORDER_ID' => $this->getID()));
		$items  = array();
		while ($item = $result->Fetch()) {
			if ($withprops) {
				$item['PROPS'] = SaleBasket::getProperties($item['ID']);
			}
			$item['SUMMARY_PRICE'] = $item['PRICE'] * $item['QUANTITY'];
			
			$items []= $item;
		}
		return $items;
	}
	
	
    /**
     * Получение списка статусов.
     */
	public static function getStatuses()
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		$result = \CSaleStatus::GetList(array('SORT' => 'ASC'));
		$items  = array();
		while ($item = $result->Fetch()) {
			$items[$item['ID']] = $item;
		}
		return $items;
	}
    
    
    /**
     * Получение ссылки на оплату.
     */
    public function getPaymentURL()
    {
        if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
        
        $bxorder = \Bitrix\Sale\Order::load($this->getID());
        $collect = $bxorder->getPaymentCollection();
        $payment = $collect->current();
        $params  = \Bitrix\Sale\PaySystem\Manager::getById($payment->getPaymentSystemId());
        $service = new \Bitrix\Sale\PaySystem\Service($params);

        ob_start();
        $service->initiatePay($payment);
        $link = ob_get_clean();
        
        return $link;
    }
}