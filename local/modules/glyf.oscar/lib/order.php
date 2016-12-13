<?php 

namespace Glyf\Oscar;


class Order extends \Glyf\Core\Helpers\SaleOrder
{
    const PROP_BALANCE_CODE = 'BALANCE';
    const PROP_PICTURE_CODE = 'PICTURE';
    const PROP_TARIFF_CODE  = 'TARIFF';
    
    
    public function recordStatisticSale()
    {
        // Корзины.
        $baskets = $this->getBaskets();
        
        foreach ($baskets as $basket) {
            $picture = new \Glyf\Oscar\Picture($basket['PRODUCT_ID']);
            $picture->recordStatisticSale($basket['PRICE'], $this->getID(), $basket['TYPE']);
        }
    }
    
    
    
    /**
     * Повтор заказа.
     */
    public static function repeat($id)
    {
        if (!\Bitrix\Main\Loader::includeModule('sale')) {
			return;
		}
        
        if (!\Bitrix\Main\Loader::includeModule('catalog')) {
			return;
		}
        
        // Новая корзина для заказа.
        $cart = array();
        
        // Заказ.
        $order = new self($id);
        
        // Корзины.
        $baskets = $order->getBaskets();
        
        // Копирование корзин заказа.
        foreach ($baskets as $basket) {
            $props = array(
                array(
                    'NAME'  => 'Повтор заказа',
                    'CODE'  => 'REPEAT',
                    'VALUE' => $id
                )
            );
            
            // Добавление товара в корзину.
            $cart = array(
                'FUSER_ID'   => \CSaleBasket::GetBasketUserID(),
                'PRODUCT_ID' => $basket['PRODUCT_ID'],
                'NAME'       => $basket['NAME'],
                'PRICE'      => 0,
                'MODULE'     => 'catalog',
                'CURRENCY'   => CURRENCY_DEFAULT,
                'QUANTITY'   => 1,
                'LID'        => SITE_DEFAULT,
                'CAN_BUY'    => 'Y',
                'DELAY'      => 'Y',
                'PROPS'      => $props,
            );
            
            if (!\CSaleBasket::Add($cart)) {
                // TODO: 
            }
        }
        
        return true;
    }
}