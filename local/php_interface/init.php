<?php

// Константы.
include ('constants.php');

// Функции.
include ('functions.php');

// Javascript-библиотеки.
include ('jslibs.php');


// Контекст.
$context = \Bitrix\Main\Context::getCurrent();

// Список возможных языков.
$APPLICATION->languages = array(
	LANG_RU => 'Русский',
	LANG_EN => 'English',
);


// Смена языка.
if (!empty($_GET['setlang'])) {
	$language = strtolower(strval($_GET['setlang']));
	if (array_key_exists($language, $APPLICATION->languages)) {
		setcookie('language', $language, time() + TIME_YEAR, '/');
		LocalRedirect($APPLICATION->GetCurPageParam('', array('setlang'), false));
	}
}

if ($language = (string) $_COOKIE['language']) {
    if (array_key_exists($language, $APPLICATION->languages) && $language != $context->getLanguage()) {
        $context->setLanguage($language);
    }
}


// Текущий язык.
define('CURRENT_LANG',    $context->getLanguage());
define('CURRENT_LANG_UP', strtoupper(CURRENT_LANG));



// События.
include ('events.php');

