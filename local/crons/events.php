<?php

@set_time_limit(0);
@ignore_user_abort(true);

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__)."/../..");

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('CHK_EVENT', true);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CAgent::CheckAgents();

define('BX_CRONTAB_SUPPORT', true);
define('BX_CRONTAB', true);

CEvent::CheckEvents();
