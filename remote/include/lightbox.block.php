<?php

define('NO_KEEP_STATISTIC',  true);
define('PULL_AJAX_INIT',     true);
define('PUBLIC_AJAX_MODE',   true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK',     true);
define('DisableEventsCheck', true);

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


// ������.
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$lid = $request->get('lid');
$tpl = $request->get('tpl');

if (!in_array($tpl, array('side', 'sidesmall'))) {
    $tpl = 'sidesmall';
}


// ���������� �� �����.					
$APPLICATION->IncludeComponent(
    "glyf:lightbox.block",
    $tpl,
    array(
        "LID" => intval($lid),
    )
);