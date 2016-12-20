<?php 

namespace Glyf\Oscar;

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\User;


IncludeModuleLangFile(__FILE__);


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
            $picture->recordStatisticSale($basket['PRICE'], $this->getID(), $basket['TYPE'], $this->getUserID());
        }
    }
    
    
    /**
     * Оплата заказа со внутрненнего счета.
     */
    public function pay(User $user)
    {
        global $DB;
        
        // Проверка наличия средств на балансе.
        if ($user->getBalance() < $this->getPrice()) {
            throw new \Exception('Insufficient funds');
        }
        
        $DB->StartTransaction();
        
        // Снятие суммы с личного счета.
        $price = \CSaleUserAccount::Withdraw($user->getID(), $this->getPrice(), CURRENCY_DEFAULT, $this->getID());
        
        // Оплата заказа.
        if ($price == $this->getPrice()) {
            \CSaleOrder::PayOrder($this->getID(), 'Y', false, false);
        } else {
            $DB->Rollback();
        }
        
        //\CSaleUserAccount::Pay($user->getID(), $this->getPrice(), DEFAULT_CURRENCY, $this->getID());
        
        $DB->Commit();
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
            $data = array(
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
                'PROPS'      => array(), // $props,
            );
            
            if (!\CSaleBasket::add($data)) {
                throw new \Exception('Error insert basket');
            }
        }
        return true;
    }
}