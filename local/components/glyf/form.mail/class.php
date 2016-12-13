<?php

use Bitrix\Main\Localization\Loc;

class FormMailComponent extends \CBitrixComponent
{
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
		// Идентификатор формы. 
		$arParams['FORM'] = (string) $arParams['FORM']; 

		// Поля формы. 
		$arParams['FIELDS'] = (array) $arParams['FIELDS']; 

		// Обязательные поля формы. 
		$arParams['REQUIRED'] = (array) $arParams['REQUIRED']; 

		// Использовать CAPTCHA. 
		$arParams['CAPTCHA'] = ($arParams['CAPTCHA'] == 'Y'); 
		
        // Не выводить шшаблон.
		$arParams['NOVISUAL'] = ($arParams['NOVISUAL'] == 'Y');
        
		
        return $arParams;
	}
	
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('iblock')) {
			return;
		}
		
		Loc::loadMessages(__FILE__);
		
		$this->arResult['ERRORS']  = array(); 
		$this->arResult['MESSAGE'] = null; 
		$this->arResult['DATA']    = array(); 

		/* 
		 * Отправка формы. 
		 */ 
		if (!empty($_POST) && isset($_REQUEST[$arParams['FORM']])) { 
			 
			$this->arResult['FIELDS'] = array(); 
			 
			foreach ($arParams['FIELDS'] as $field) {
				if (is_array($_POST[$field])) {
					$value = array_map('strval', $_POST[$field]);
				} else {
					$value = (string) $_POST[$field];
				}
				
				if (in_array($field, $arParams['REQUIRED']) && empty($value)) { 
					$this->arResult['ERRORS'][$field] = GetMessage('GL_FORM_MAIL_ERROR_EMPTY_REQUIRED');
				} else { 
					if (is_array($value)) {
						$fval = implode(PHP_EOL, $value);
					} else {
						$fval = $value;
					}
					$this->arResult['FIELDS'][$field] = $fval;
				}
				
				$this->arResult['DATA'][$field] = $value;
			}
			 
			// Проверка CAPTCHA. 
			if ($arParams['CAPTCHA']) {
				if (!$APPLICATION->CaptchaCheckCode($_POST['CAPTCHA_WORD'], $_POST['CAPTCHA_CODE'])) { 
					$this->arResult['ERRORS']['CAPTCHA'] = GetMessage('GL_FORM_MAIL_ERROR_EMPTY_CAPTCHA'); 
				} 
			} 
			 
			// Событие. 
			foreach (GetModuleEvents('glyf.core', 'OnBeforeFormMailSend', true) as $arEvent) { 
				ExecuteModuleEventEx($arEvent, array(&$arParams, &$this->arResult)); 
			} 
			
			// Отправка сообщения. 
			if (empty($this->arResult['ERRORS'])) {
				if (CEvent::Send($arParams['FORM'], SITE_ID, $this->arResult['FIELDS'])) { 
					$this->arResult['SUCCESS'] = true;
					$this->arResult['MESSAGE'] = GetMessage('GL_FORM_MAIL_SUCCESS_MAIL_SEND');
					$this->arResult['DATA'] = array(); 
				} 
			} else {
				$this->arResult['SUCCESS'] = false;
			}
			 
			// Событие. 
			foreach (GetModuleEvents('glyf.core', 'OnAfterFormMailSend', true) as $arEvent) { 
				ExecuteModuleEventEx($arEvent, array($arParams, $this->arResult)); 
			}
		} 

		// CAPTCHA. 
		if ($arParams['CAPTCHA']) { 
			include_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/captcha.php'); 
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captchaPass) <= 0) {
				$captchaPass = randString(10);
				COption::SetOptionString("main", "captcha_password", $captchaPass); 
			}
			$cpt->SetCodeCrypt($captchaPass);
			
			$this->arResult['CAPTCHA'] = $cpt;
		} 

		// Событие. 
		foreach (GetModuleEvents('glyf.core', 'OnFormMailShow', true) as $arEvent) {
			ExecuteModuleEventEx($arEvent, array(&$arParams, &$this->arResult));
		}
		
		// Подключение шаблона компонента.
        if (!$this->arParams['NOVISUAL']) {
            $this->IncludeComponentTemplate();
        }
		
		return $this->arResult;
	}
	
}
