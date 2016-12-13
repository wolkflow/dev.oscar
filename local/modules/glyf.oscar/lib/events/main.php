<?php
 
namespace Glyf\Oscar\Events;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);


/**
 * Обработчик событий главного модуля.
 */
class Main
{
    /**
     * Регистрация пользователя.
     */
    public static function OnBeforeUserRegister(&$fields)
    {
        $request = Application::getInstance()->getContext()->getRequest();
        
        // Используем e-mail в качестве логина.
        $fields['EMAIL'] = $fields['LOGIN'];
        
        // Соглашение.
        if ($request->get('AGREEMENT') != 'Y') {
            $GLOBALS['APPLICATION']->ThrowException(Loc::getMessage('GL_REGISTER_ERROR_OFFER_CONTRACT')); 
            return false;
        }
    }
    
    /**
     * Регистрация пользователя.
     */
    public static function OnAfterUserRegister($fields)
    {
        if ($fields['USER_ID'] > 0) {
            if (\Bitrix\Main\Loader::includeModule('sale')) {
                // Создание аккаунта.
                \CSaleUserAccount::Add(array(
                    'USER_ID' => $fields['ID'],
                    'CURRENT_BUDGET' => 0,
                    'CURRENCY' => CURRENCY_DEFAULT
                ));
            }
            
            // Подписка пользователя.
            $subscribe = new \Glyf\Oscar\Subscribe();
            $subscribe->add(array(
                \Glyf\Oscar\Subscribe::FIELD_USER_ID  => $fields['ID'],
                \Glyf\Oscar\Subscribe::FIELD_ACTIVE => false,
            ));
            
            // Разрешенные IP-адреса пользователя.
            $ipaddress = new \Glyf\Oscar\IPAddress();
            $ipaddress->add(array(
                \Glyf\Oscar\IPAddress::FIELD_USER_ID  => $fields['ID'],
                \Glyf\Oscar\IPAddress::FIELD_TIME     => date('d.m.Y H:i:s'),
            ));
        }
    }
    
}