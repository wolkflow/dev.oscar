<?php

if (\Bitrix\Main\Loader::includeModule('glyf.core')) {
	AddEventHandler('main', 'OnProlog', array('\Glyf\Core\Events\Main', 'onProlog'));
}

if (\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
	AddEventHandler('main', 'OnBeforeUserRegister', array('\Glyf\Oscar\Events\Main', 'OnBeforeUserRegister'));
    AddEventHandler('main', 'OnAfterUserRegister', array('\Glyf\Oscar\Events\Main', 'OnAfterUserRegister'));
}