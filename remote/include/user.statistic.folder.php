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

$fid   = $request->get('fid');
$count = $request->get('count');
$page  = $request->get('page');
$order = $request->get('order');

// Статистика по папке.					
$APPLICATION->IncludeComponent(
    "glyf:statistic.folder",
    "remote-profile",
    array(
        "FID"     => intval($fid),
        "PAGE"    => intval($page),
        "PERPAGE" => intval($count),
        "ORDER"   => strval($order),        
    )
);