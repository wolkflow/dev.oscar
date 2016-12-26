<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

// Получение результатов платежной системы.
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment.receive",
    "",
    array(
        "PAY_SYSTEM_ID"  => PAYSYSTEM_ROBOKASSA,
        "PERSON_TYPE_ID" => PERSON_TYPE_DEFAULT,
    ),
);