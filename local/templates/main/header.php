<!DOCTYPE html>
<html lang="en">
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
    
    <? $APPLICATION->ShowHead() ?>
</head>
<body class="mainPage">
	<div class="wrapper">
		
		<header class="siteHeader">
			<div class="container">
				<div class="logo">
					<a href="/">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo.png" alt="OSCAR art agency" />
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
							<a href="#" class="dropdown-toggle">
								<span class="selected">RU</span>
								<i class="icon icon-lang"></i>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">EN</a></li>
							</ul>
						</li>
					</ul>
					
					<? // Корзина // ?>
					<ul class="nav navbar-cart hidden-xs">
						<li>
							<a href="#">
								<span class="cart-count">5</span>
								<i class="icon icon-cart"></i>
							</a>
						</li>
					</ul>
					
					<? // Формарегистрации и авторизации // ?>
					<ul class="nav navbar-login hidden-xs">
						<li class="login">
							<a href="#">Войти</a>
						</li>
						<li>
							<a href="javascript:void(0)" data-modal="#modal-register">Регистрация</a>
						</li>
					</ul>
					
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
									<a href="#">Войти</a>
								</li>
								<li>
									<a href="javascript:void(0)" data-modal="#modal-register">Регистрация</a>
								</li>
							</ul>

							<ul class="nav navbar-cart">
								<li>
									<a href="#">
										<span class="cart-count">5</span>
										<i class="icon icon-cart"></i>
									</a>
								</li>
							</ul>
							
							<ul class="nav navbar-lang">
								<li>
									<a href="#" class="lang-toggle">
										<span class="selected">RU</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</header>
        