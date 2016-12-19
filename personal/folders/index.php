<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Персональная статистика"); ?>

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
    <div class="cabinet-menu">
        <a href="/personal/">общие сведения пользователя</a>
        <a class="is-active" href="/personal/folders/">каталог</a>
    </div>
    <div class="container">
        <div class="row">
          <div class="cabinet-content col-md-12 col-sm-12">
            
            <ol class="breadcrumb">
                <li><a href="/personal/">Личный кабинет</a></li>
                <li>Каталог</li>
            </ol>

            <?	// Статистика по папкам.					
                $APPLICATION->IncludeComponent(
                    "glyf:statistic.folders",
                    "profile",
                    array()
                );
            ?>
            
            <?	// Статистика по обектам.					
                $APPLICATION->IncludeComponent(
                    "glyf:statistic.objects",
                    "profile",
                    array()
                );
            ?>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>