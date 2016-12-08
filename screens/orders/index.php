<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>

<?  // Статистика продаж PDF.
    $APPLICATION->IncludeComponent(
        "glyf:pdf.orders",
        "",
        array("IDS" => $_REQUEST['IDS'])
    );
?>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>