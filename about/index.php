<? define('PAGE', 'ABOUT') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Art Agency"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
	<div class="container">
		<article class="inftext">
			<div class="row">
				<h1>
					<?  // Заголовок.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/about/header.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</h1>
				<div class="col-sm-6 col-lg-4 col-lg-offset-2">
					<?  // Левый столбец.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/about/sideleft.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</div>
				<div class="col-sm-6 col-lg-4">
					<?  // Правый столбец.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/about/sideright.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</div>
			</div>
		</article>
	</div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>