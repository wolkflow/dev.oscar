<? define('PAGE', 'MAIN') ?>
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
	<? // Главное меню.
		$APPLICATION->IncludeComponent(
			"glyf:main.menu",
			"",
			array()
		);
	?>
	
	<div class="content">
		<div class="mainAbout">
			<div class="container">
				<div class="row">
					<h3>
						<?  // Заголовок (общий).
							$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
								'AREA_FILE_SHOW' => 'file',
								'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-header.php',
								'EDIT_TEMPLATE' => 'html'
							));
						?>
					</h3>
					<div class="col-sm-6 col-lg-4 col-lg-offset-2">
						<h4>
							<?  // Заголовок (левый).
								$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
									'AREA_FILE_SHOW' => 'file',
									'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-left-header.php',
									'EDIT_TEMPLATE' => 'html'
								));
							?>
						</h4>
						<p>
							<?  // Текст (левый).
								$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
									'AREA_FILE_SHOW' => 'file',
									'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-left-text.php',
									'EDIT_TEMPLATE' => 'html'
								));
							?>
						</p>
					</div>
					<div class="col-sm-6 col-lg-4">
						<h4>
							<?  // Заголовок (правый).
								$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
									'AREA_FILE_SHOW' => 'file',
									'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-right-header.php',
									'EDIT_TEMPLATE' => 'html'
								));
							?>
						</h4>
						<p>
							<?  // Текст (правый).
								$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
									'AREA_FILE_SHOW' => 'file',
									'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-right-text.php',
									'EDIT_TEMPLATE' => 'html'
								));
							?>
						</p>
					</div>
				</div>
				<a href="/about/" class="btn btn-more">
					<?  // Ссылка.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/content/main.main-about-link.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</a>
			</div>
		</div>
	</div>

	<?  // Регистрация и документы.
		$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
			'AREA_FILE_SHOW' => 'file',
			'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.register-docs-block.php',
			'EDIT_TEMPLATE' => 'html'
		));
	?>
	
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