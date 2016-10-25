<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/*

$filter = array(		
    'ACTIVE'    => 'Y',
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
);
$select = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'UF_LANG_TITLE_' . CURRENT_LANG_UP);
$order  = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
$result = CIBlockSection::GetList($order, $filter, false, $select);

*/

// Построение дерева разделов (коллекций).
$arResult['ROOT'] = array();

$slink = array();
$slink[0] = &$arResult['ROOT'];

foreach ($arResult['SECTIONS'] as $section) {
    $slink[intval($section['IBLOCK_SECTION_ID'])]['CHILDREN'][$section['ID']] = $section;
    $slink[$section['ID']] = &$slink[intval($section['IBLOCK_SECTION_ID'])]['CHILDREN'][$section['ID']];
}
unset($slink);
unset($arResult['SECTIONS']);

