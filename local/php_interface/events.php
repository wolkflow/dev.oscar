<?php

if (\Bitrix\Main\Loader::includeModule('glyf.core')) {
	AddEventHandler('main', 'OnProlog', array('\Glyf\Core\Events\Main', 'onProlog'));
}