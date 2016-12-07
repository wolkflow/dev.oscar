<?php

define('NO_KEEP_STATISTIC', true);
define('PULL_AJAX_INIT', true);
define('PUBLIC_AJAX_MODE', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('DisableEventsCheck', true);


$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname(dirname(__FILE__))));

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


Bitrix\Main\Loader::includeModule('glyf.core');
Bitrix\Main\Loader::includeModule('glyf.oscar');


$mail = new Glyf\Oscar\Agents\Mailing();
$mail->mail();