<? define('PAGE', 'CONTACTS') ?>
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
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/contacts/header.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</h1>
				<div class="col-sm-6 col-lg-4 col-lg-offset-2">
					<?  // Левый столбец.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/contacts/sideleft.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</div>
				<div class="col-sm-6 col-lg-4">
					<?  // Правый столбец.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/contacts/sideright.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</div>
			</div>
		</article>
	</div>
	
	<?	// Форма отправки контакта.
		$APPLICATION->IncludeComponent(
			"glyf:form.mail",
			"contacts",
			array(
				'FORM'     => 'GL_CONTACT',
				'CAPTCHA'  => 'N',
				'FIELDS'   => array('NAME', 'PHONE', 'EMAIL'),
				'REQUIRED' => array('NAME', 'PHONE', 'EMAIL'),
			)		
		);
	?>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>