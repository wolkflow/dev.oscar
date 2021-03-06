<?php

define('NO_KEEP_STATISTIC',  true);
define('PULL_AJAX_INIT',     true);
define('PUBLIC_AJAX_MODE',   true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK',     true);
define('DisableEventsCheck', true);

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


// Запрос.
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$page  = $request->get('page');
$sort  = $request->get('sort');
$count = $request->get('count');
$title = $request->get('title');
$prmin = $request->get('prmin');
$prmax = $request->get('prmax');

// Статистика по папке.					
$APPLICATION->IncludeComponent(
    "glyf:statistic.sales",
    "remote-profile",
    array(
        "PAGE"       => intval($page),
        "PERPAGE"    => intval($count), 
        "TITLE"      => strval($title),
        "ORDER"      => strval($sort),
        "PERIOD_MIN" => strval($prmin),
        "PERIOD_MAX" => strval($prmax),
    )
);