<?php

if (\Bitrix\Main\Loader::includeModule('glyf.core')) {
	AddEventHandler('main', 'OnProlog', array('\Glyf\Core\Events\Main', 'onProlog'));
}

if (\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
	AddEventHandler('main', 'OnBeforeUserRegister', array('\Glyf\Oscar\Events\Main', 'OnBeforeUserRegister'));
    AddEventHandler('main', 'OnAfterUserRegister', array('\Glyf\Oscar\Events\Main', 'OnAfterUserRegister'));
    AddEventHandler('sale', 'onSalePayOrder', array('\Glyf\Oscar\Events\Sale', 'onSalePayOrder'));
    
    
    $manager = \Bitrix\Main\EventManager::getInstance();
    $manager->addEventHandler('', 'PicturesOnBeforeUpdate',  array('\Glyf\Oscar\Events\EventPicture', 'onBeforeUpdate'));
    $manager->addEventHandler('', 'PicturesOnAfterUpdate',  array('\Glyf\Oscar\Events\EventPicture', 'onAfterUpdate'));
}

