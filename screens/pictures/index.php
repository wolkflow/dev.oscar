<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>

<?  // Изображения PDF.
    $APPLICATION->IncludeComponent(
        "glyf:pdf.pictures",
        "",
        array(
            "UID"  => $_REQUEST['UID'],
            "PIDS" => $_REQUEST['PIDS'],
            "FIDS" => $_REQUEST['FIDS'],
            "LIDS" => $_REQUEST['LIDS'],
        )
    );
?>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>