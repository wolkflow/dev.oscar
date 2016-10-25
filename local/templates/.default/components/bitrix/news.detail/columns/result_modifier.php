<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Glyf\Core\Helpers\Text as TextHelper;

\Bitrix\Main\Loader::includeModule('glyf.core');


// Разбиение текста на 2 колонки.
$arResult['TEXTS'] = TextHelper::split($arResult['PROPERTIES']['LANG_TEXT_'.CURRENT_LANG_UP]['VALUE']['TEXT']);
