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
    public function OnSalePayOrder($id, $pay)
    {
        if ($pay == 'Y') {
            
        }
    }
    
    
}