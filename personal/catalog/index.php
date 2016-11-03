<? define('PAGE', 'UPLOAD') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Загрузка изображения"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain page-cabinet">
    <? if (CUser::IsAuthorized()) { ?>
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
    <? } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <div class="errorPage">
                        <div class="errorPageTitle">Ошибка доступа</div>
                        <div class="errorPageMessage">
                            <p>Вы не авторизованы на сайте.<br/>Для продолженя работы нажмите на ссылку "Войти"!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>