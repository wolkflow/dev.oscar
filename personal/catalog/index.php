<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Каталог"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain page-cabinet">
    <? $user = new Glyf\Oscar\User() ?>
    
    <? if (!$user->isPartner()) { ?>
        <? LocalRedirect('/personal/') ?>
    <? } ?>
    
    <div class="cabinet-menu">
        <a href="/personal/">Общие сведения пользователя</a>
        <a class="is-active" href="/personal/catalog/">Каталог</a>
    </div>
    
    <div class="container">
        <div class="row">
            <?	// Статистика.					
                $APPLICATION->IncludeComponent(
                    "glyf:statistic.collections",
                    "profile",
                    array()
                );
            ?>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>