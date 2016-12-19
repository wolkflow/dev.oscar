<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Art Agency"); ?>

<?  // Проверка пользователя.
    $user = new Glyf\Oscar\User();
    if ($user->isPartner()) {
        LocalRedirect('/personal/');
    }
?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
    <div class="container">
        <div class="row flex">
            <div class="col-md-10 col-sm-9">
                <?	// Статистика по папке.					
                    $APPLICATION->IncludeComponent(
                        "glyf:user.lightbox",
                        "profile",
                        array("LID" => intval($_REQUEST['ELEMENT']))
                    );
                ?>
            </div>
            <div class="col-md-2 col-sm-3 hidden-xs">
                <?	// Сборники.					
                    $APPLICATION->IncludeComponent(
                        "glyf:lightbox.list",
                        "sidesmall",
                        array()
                    );
                ?>
            </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>