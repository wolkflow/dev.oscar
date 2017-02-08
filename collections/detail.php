<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Collection"); ?>

<? IncludeFileLangFile(__FILE__) ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
    <div class="content">
        <div class="container">
            <div class="row flex">
                <?  // Картина.
                    $APPLICATION->IncludeComponent(
                        "glyf:picture.detail",
                        "picture",
                        array("PID" => intval($_REQUEST['ELEMENT']))
                    );
                ?>
                
                <?  // Сборники.
                    $APPLICATION->IncludeComponent(
                        "glyf:lightbox.list",
                        "side",
                        array()
                    );
                ?>
            </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>