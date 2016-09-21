<?php

// Константы.
include ('constants.php');

// Контекст.
$context = \Bitrix\Main\Context::getCurrent();

// Список возможных языков.
$APPLICATION->languages = array(
	'ru' => 'Русский',
	'en' => 'English',
);


// Смена языка.
if (!empty($_GET['setlang'])) {
	$language = strtolower(strval($_GET['setlang']));
	if (array_key_exists($language, $APPLICATION->languages)) {
		$APPLICATION->set_cookie('language', strval($language));
		LocalRedirect($APPLICATION->GetCurPageParam('', array('setlang'), false));
	}
}
if ($language = $APPLICATION->get_cookie('language')) {
    if (array_key_exists($language, $APPLICATION->languages) && $language != $context->getLanguage()) {
        \Bitrix\Main\Context::getCurrent()->setLanguage($language);
    }
}

// Текущий язык.
define('CURRENT_LANG',    $context->getLanguage());
define('CURRENT_LANG_UP', strtoupper(CURRENT_LANG));
