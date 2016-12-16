<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

// Получение результатов платежной системы.
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment.receive",
    "",
    array(
        "PAY_SYSTEM_ID_NEW" => PAYSYSTEM_ROBOKASSA
    ),
);