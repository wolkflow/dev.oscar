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

$pid = $request->get('pid');
$bid = $request->get('bid');


// Заказы пользователя.					
$APPLICATION->IncludeComponent(
    "glyf:picture.buyout",
    "buyout",
    array(
        "PID" => $pid,
        "BID" => $bid,
    )
);