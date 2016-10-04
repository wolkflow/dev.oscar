<?php

return;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$module = 'glyf.oscar';

if (IsModuleInstalled($module)) {

    if (!\Bitrix\Main\Loader::includeModule($module)) {
        return;
    }	
	
	/*
     * Событие для других модулей.
     */
    $events = GetModuleEvents('glyf.oscar', 'OnAfterAdminMenuBuild');
    while ($arEvent = $events->Fetch()) {
        try {
            ExecuteModuleEventEx($arEvent, array(&$aMenu));
        } catch (Exception $e) {
            throw $e;
        }
    }

    return $aMenu;
}