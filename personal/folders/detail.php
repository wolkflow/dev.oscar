<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Персональная статистика"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>
<?  // Данные отображения.

    // Запрос.
    $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    
    $order = $request->get('order');
    $count = $request->get('count');
    $page  = $request->get('page');

?>
<main class="siteMain page-cabinet">
    <? if (CUser::IsAuthorized()) { ?>
        <div class="container">
            <div class="row">
                <?	// Статистика по папке.					
                    $APPLICATION->IncludeComponent(
                        "glyf:statistic.folder",
                        "profile",
                        array(
                            "FID"   => intval($_REQUEST['ELEMENT']),
                            "PAGE"  => $page,
                            "COUNT" => $count                            
                        )
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