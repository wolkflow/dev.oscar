<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$section = CIBlockSection::getList(
	array(), 
	array('IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ID' => $arResult['IBLOCK_SECTION_ID']), 
	false, 
	array('UF_LANG_TITLE_RU', 'UF_LANG_TITLE_EN')
)->GetNext();


// Корневая папка - блог.
$APPLICATION->AddChainItem(getMessage('GL_BLOG'), '/blog/');

// Раздел.
$APPLICATION->AddChainItem($section['UF_LANG_TITLE_'.CURRENT_LANG_UP], $section['SECTION_PAGE_URL']);

// Статья.
$APPLICATION->AddChainItem($arResult['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'], $arResult['DETAIL_PAGE_URL']);