<?php

@set_time_limit(0);
@ignore_user_abort(true);

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__)."/../..");

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('CHK_EVENT', true);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

Bitrix\Main\Loader::includeModule('glyf.core');
Bitrix\Main\Loader::includeModule('glyf.oscar');

// Свойства HL-блока.
$props = Glyf\Core\Helpers\HLBlock::getProps(HLBLOCK_SUBSCRIBES_ID, 'FIELD_NAME', 'ID');

// Варианты периодов рассылки.
$periods = array();
foreach ($props[Subscribe::FIELD_PERIOD]['ENUMS'] as $enum) {
    $periods[$enum['XML_ID']] = array('ID' => $enum['ID'], 'CODE' => $enum['XML_ID'], 'TITLE' => $enum['VALUE']);
}