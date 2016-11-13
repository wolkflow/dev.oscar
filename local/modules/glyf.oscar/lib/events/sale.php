<?php
 
namespace Glyf\Oscar\Events;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);


/**
 * Обработчик событий главного модуля.
 */
class Sale
{
    /**
     * Регистрация пользователя.
     */
    public static function onSalePayOrder($id, $pay)
	{
        if ($pay == 'Y') {
            $user  = new \Glyf\Oscar\User();
            $order = new \Glyf\Oscar\Order($id);
            
            $data = $order->getData();
            $data['PROPS'] = $order->getProperties();
            
            // Пополнение баланса.
            if ($data['PROPS'][\Glyf\Oscar\Order::PROP_BALANCE_CODE]['VALUE'] == 'Y') {
                \CSaleUserAccount::UpdateAccount(
                    $user->getID(),
                    $user->getBalance() + floatval($data['PRICE']),
                    CURRENCY_DEFAULT,
                    'BALANCE',
                    $order->getID()
                );
            }
        }
    }
    
    
}