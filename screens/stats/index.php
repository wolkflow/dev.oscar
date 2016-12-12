<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>

<?  // Статистика продаж PDF.
    $APPLICATION->IncludeComponent(
        "glyf:pdf.stats",
        "",
        array(
            "UID"        => $_REQUEST['UID'],
            "IDS"        => $_REQUEST['IDS'],
            "PERIOD_MIN" => strval($_REQUEST['PERIOD_MIN']),
            "PERIOD_MAX" => strval($_REQUEST['PERIOD_MAX']),
        )
    );
?>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>