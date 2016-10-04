<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['SECTIONS'] = array();

if (!empty($arResult['ITEMS'])) {
	foreach ($arResult['ITEMS'] as &$item) {
		
		if (!array_key_exists($item['IBLOCK_SECTION_ID'], $arResult['SECTIONS'])) {
			$section = CIBlockSection::getList(
				array(), 
				array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $item['IBLOCK_SECTION_ID']), 
				false, 
				array('UF_LANG_TITLE_RU', 'UF_LANG_TITLE_EN')
			)->getNext();
			
			$arResult['SECTIONS'][$section['ID']] = $section;
 		}
		
		$item['SECTION_LANG_TITLE'] = $arResult['SECTIONS'][$item['IBLOCK_SECTION_ID']]['UF_LANG_TITLE_'.CURRENT_LANG_UP];
	}
}