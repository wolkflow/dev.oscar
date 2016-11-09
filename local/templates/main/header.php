<!DOCTYPE html>
<html lang="<?= CURRENT_LANG ?>">
	<? use Bitrix\Main\Localization\Loc; ?>
	<? IncludeAreaLangFile(__FILE__); ?>

	<head>
		<? $asset = \Bitrix\Main\Page\Asset::getInstance(); ?>

		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<title><? $APPLICATION->ShowTitle() ?></title>

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<? /* <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> */ ?>
        
        
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.autocomplete.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/gui.js"></script>
        
		<? $APPLICATION->ShowHead() ?>
	</head>
	<body <?= (in_array(PAGE, array('MAIN', 'ABOUT', 'CONTACTS', 'RULES', 'UPLOAD', '404'))) ? ('class="mainPage"') : ('') ?>>
		<div id="panel">
			<? $APPLICATION->ShowPanel() ?>
		</div>
		<div class="wrapper">
			
			<header class="siteHeader">
				<div class="container">
					<div class="logo">
						<a href="/">
							<? if (in_array(PAGE, array('MAIN', 'ABOUT', 'CONTACTS', 'RULES', 'UPLOAD', '404'))) { ?>
								<img src="<?= SITE_TEMPLATE_PATH ?>/images/logo.png" alt="OSCAR art agency" />
							<? } else { ?>
								<img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-small.png" alt="OSCAR art agency" />
							<? } ?>
						</a>
					</div>
					<nav class="menu">
						<div class="menu-header">
							<button type="button" class="nav-toggle collapsed" data-target="#navbar" id="pull">
								<span class="sr-only">Показать или скрыть меню</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<ul class="nav navbar-lang hidden-xs">
							<li class="dropdown">
								<a href="javascript:void(0)" class="dropdown-toggle">
									<span class="selected"><?= CURRENT_LANG_UP ?></span>
									<i class="icon icon-lang"></i>
								</a>
								<ul class="dropdown-menu">
									<? foreach ($APPLICATION->languages as $lang => $language) { ?>
										<? if ($lang == CURRENT_LANG) continue; ?>
										<li>
											<a href="<?= $APPLICATION->GetCurPageParam('setlang='.$lang, array('setlang'), false) ?>">
												<?= $language ?>
											</a>
										</li>
									<? } ?>
								</ul>
							</li>
						</ul>
						
                        
						<?	// Корзина.
                            $APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket",
                                "header",
                                array()		
                            );
                        ?>
						
						<?  // Ссылки авториазции / регистрации.
							$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
								'AREA_FILE_SHOW' => 'file',
								'PATH' => SITE_TEMPLATE_PATH.'/include/area/login.popup.php',
								'EDIT_TEMPLATE' => 'html',
								'CSS' => 'navbar-login hidden-xs'
							));
						?>
						
						<div id="navbar" class="navbar-collapse collapse">
							<?  // Меню.
								$APPLICATION->IncludeComponent(
									'bitrix:menu',
									'top',
									array(
										'ROOT_MENU_TYPE' => 'main.' . CURRENT_LANG,
										'MENU_CACHE_TYPE' => 'Y',
										'MENU_CACHE_TIME' => '36000000',
										'MENU_CACHE_USE_GROUPS' => 'N',
										'MENU_CACHE_GET_VARS' => array(),
										'MAX_LEVEL' => '1',
										'USE_EXT' => 'N',
										'ALLOW_MULTI_SELECT' => 'N'
									)
								);
							?>
							
							<div class="visible-xs double-menu">

								<ul class="nav navbar-login">
									<li class="login">
										<a href="#">
											<?= getMessage('GL_SIGN_IN') ?>
										</a>
									</li>
									<li>
										<a href="javascript:void(0)" data-modal="#modal-register">
											<?= getMessage('GL_REGISTER') ?>
										</a>
									</li>
								</ul>

								<ul class="nav navbar-cart">
									<li>
										<a href="#">
											<span class="cart-count">0</span>
											<i class="icon icon-cart"></i>
										</a>
									</li>
								</ul>
								
								<ul class="nav navbar-lang">
									<li>
										<a href="/" class="lang-toggle">
											<span class="selected"><?= CURRENT_LANG_UP ?></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</header>
        