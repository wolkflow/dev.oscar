<?php

define('PAGE', '404');

include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

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
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
					<div class="errorPage">
						<div class="errorPageTitle-sub">ошибка 404</div>
						<div class="errorPageTitle">страница не найдена</div>
						<div class="errorPageContainer">
							<img src="<?= SITE_TEMPLATE_PATH ?>/images/error.png" />
							<div class="errorPageQuery">
								<p><b>«Препятствие пустоты»</b></p>
								<p>рене магритт</p>
							</div>
						</div>
						<a href="#" class="errorPageSearch"></a>
						<div class="errorPageMessage">
							попробуйте расширенный<br>
							поиск по сайту или напишите нам
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

<? require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>