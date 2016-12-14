<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain errorAuth">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                <div class="errorPage">
                    <div class="errorPageTitle">
                        <?= getMessage('GL_ERROR_ACCESS') ?>
                    </div>
                    <div class="errorPageMessage">
                        <p><?= getMessage('GL_ERROR_NOT_AUTHORIZED') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
