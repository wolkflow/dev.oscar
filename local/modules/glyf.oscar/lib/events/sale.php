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
        $user  = new \Glyf\Oscar\User();
        $order = new \Glyf\Oscar\Order($id);
        
        $data = $order->getData();
        $data['PROPS'] = $order->getProperties();
        
        if ($pay == 'Y') {
            
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
            
            // Активация тарифа.
            if ($data['PROPS'][\Glyf\Oscar\Order::PROP_TARIFF_CODE]['VALUE'] == 'Y') {
                $tariff = \Glyf\Oscar\OrderTariff::getByOrderID($order->getID());
                
                if (!empty($tariff) && is_object($tariff)) {
                    $tariff->activate();
                }
            }
            
            // Запись в статистику о покупке изображения.
            if ($data['PROPS'][\Glyf\Oscar\Order::PROP_PICTURE_CODE]['VALUE'] == 'Y') {
                $order->recordStatisticSale();
            }
            
        } else {
            
            // Деактивация тарифа.
            if ($data['PROPS'][\Glyf\Oscar\Order::PROP_TARIFF_CODE]['VALUE'] == 'Y') {
                //$order->recordStatisticSale();
            }
            
        }
    }
    
    
}