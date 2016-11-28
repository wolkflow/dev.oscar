<?php 

namespace Glyf\Oscar;


class Order extends \Glyf\Core\Helpers\SaleOrder
{
    const PROP_BALANCE_CODE = 'BALANCE';
    const PROP_PICTURE_CODE = 'PICTURE';
    const PROP_TARIFF_CODE  = 'TARIFF';
    
    
    public function recordStatisticSale()
    {
        // Данные заказа.
        $order = $this->getData();
        
        
        if ($order['XML_ID'] != \Glyf\Oscar\Order::PROP_PICTURE_CODE) {
            return;
        }
        
        // Корзины.
        $baskets = $this->getBaskets();
        
        foreach ($baskets as $basket) {
            $picture = new \Glyf\Oscar\Picture($basket['PRODUCT_ID']);
            $picture->recordStatisticSale($basket['PRICE'] $this->getID(), $basket['TYPE']);
        }
    }
       
}