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
    public function OnBeforeUserRegister(&$fields)
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
}