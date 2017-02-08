<? define('NNED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Collection"); ?>

<?  // Проверка пользователя.
    $user = new Glyf\Oscar\User();
    if (!$user->isPartner()) {
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

<main class="siteMain page-cabinet">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <?  // Картина.
                    $APPLICATION->IncludeComponent(
                        "glyf:user.picture",
                        "picture",
                        array("PID" => intval($_REQUEST['ELEMENT']))
                    );
                ?>
            </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>