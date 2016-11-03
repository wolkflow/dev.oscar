<?php

namespace Glyf\Core\Helpers;

class SaleBasket
{	
	public static function getProperties($id, $code = 'CODE')
	{
		if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
		
		$result = \CSaleBasket::GetPropsList(array('SORT' => 'ASC'), array('BASKET_ID' => intval($id)));
		$items  = array();
		while ($item = $result->Fetch()) {
		   $items[$item[$code]] = $item;
		}
		return $items;
	}

}