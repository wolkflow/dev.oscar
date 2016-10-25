<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['ERROR'] = null;

if (!empty($arResult['ERRORS'])) {
    $errors = array();
    foreach ($arResult['ERRORS'] as $key => $error) {
        if (!is_numeric($key)) {
            continue;
        }
       $errors []= $error; 
    }
    $arResult['ERROR'] = implode('<br/>', $errors);
    $arResult['ERROR'] = str_replace(array('Логин', 'логин', 'Login', 'login'), 'E-mail', $arResult['ERROR']);
}