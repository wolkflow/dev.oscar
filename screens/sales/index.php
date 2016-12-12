<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>

<?  // Статистика продаж PDF.
    $APPLICATION->IncludeComponent(
        "glyf:pdf.sales",
        "",
        array(
            "UID" => $_REQUEST['UID'],
            "IDS" => $_REQUEST['IDS'],
        )
    );
?>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>