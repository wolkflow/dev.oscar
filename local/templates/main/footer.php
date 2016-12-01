            <div class="siteFooter">
                <div class="container">
                    <div class="row">
                        <ul class="nav navbar-cart footer-cart visible-xs">
                            <li>
                                <a href="#">
                                    <span class="cart-count">0</span>
                                    <i class="icon icon-cart"></i>
                                </a>
                            </li>
                        </ul>
						
						<?  // Ссылки авториазции / регистрации.
							$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
								'AREA_FILE_SHOW' => 'file',
								'PATH' => SITE_TEMPLATE_PATH.'/include/area/login.popup.php',
								'EDIT_TEMPLATE' => 'html',
								'CSS' => 'footer-login'
							));
						?>
						
                        <div class="col-sm-2 col-footer-logo">
                            <div class="footer-logo">
                                <a href="/">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-footer.png" />
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-8">
							<?  // Меню.
								$APPLICATION->IncludeComponent(
									'bitrix:menu',
									'bottom',
									array(
										'ROOT_MENU_TYPE' => 'bottom.' . CURRENT_LANG,
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
                            
                            <div class="row">
                                <div class="col-xs-11 col-xs-offset-1 col-sm-12 col-sm-offset-0">
                                    <div class="siteFooterContacts">
										<?  // Телефон.
											$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
												'AREA_FILE_SHOW' => 'file',
												'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/phone.php',
												'EDIT_TEMPLATE' => 'html'
											));
										?>
										<?  // E-mail.
											$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
												'AREA_FILE_SHOW' => 'file',
												'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/email.php',
												'EDIT_TEMPLATE' => 'html'
											));
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="copyright">
                                <?  // Копирайт.
									$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
										'AREA_FILE_SHOW' => 'file',
										'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/copy.php',
										'EDIT_TEMPLATE' => 'html'
									));
								?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="madeby">
								<?  // Дизайн.
									$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
										'AREA_FILE_SHOW' => 'file',
										'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/design.php',
										'EDIT_TEMPLATE' => 'html'
									));
								?>
								<?  // Разработка.
									$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
										'AREA_FILE_SHOW' => 'file',
										'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/development.php',
										'EDIT_TEMPLATE' => 'html'
									));
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <? // Форма ошибки // ?>
        <div class="hide">
            <div class="modal modal-error" id="error">
                <div class="modalTitle">
                    Ошибка!
                    <div class="modalClose arcticmodal-close"></div>
                </div>
                <div class="modalContent">
                    <div class="errorCode" id="js-error-popup-title-id"></div>
                    <div class="errorText" id="js-error-popup-text-id"></div>
                </div>
            </div>
        </div>
        
        <div class="hide">
            <?  // Форма поиска (popup).
				$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
					'AREA_FILE_SHOW' => 'file',
					'PATH' => SITE_TEMPLATE_PATH.'/include/area/search.php',
					'EDIT_TEMPLATE' => 'html'
				));
			?>
			
			<?	// Формаа авторизации.
				$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"popup",
					array(
						"REGISTER_URL" => "",
						"FORGOT_PASSWORD_URL" => "",
						"PROFILE_URL" => "/profile/",
						"SHOW_ERRORS" => "Y" 
					)
				);
			?>
			
            <?	// Регистрация.
                $APPLICATION->IncludeComponent(
                    "bitrix:main.register",
                    "popup",
                    array(
                        "USER_PROPERTY_NAME" => "",
                        "SEF_MODE" => "N",
                        "SHOW_FIELDS" => array(
                            "NAME",
                            "EMAIL",
                            "WORK_COMPANY",
                            "WORK_POSITION",
                        ),
                        "REQUIRED_FIELDS" => array(
                            "NAME",
                        ),
                        "AUTH" => "Y",
                        "USE_BACKURL" => "N",
                        "SUCCESS_PAGE" => (!empty($_COOKIE['backurl'])) ? (strval($_COOKIE['backurl'])) :("/"),
                        "SET_TITLE" => "N",
                        "USER_PROPERTY" => array(),
                        "SEF_FOLDER" => "",
                        "VARIABLE_ALIASES" => array(),
                    )
                );
            ?>
        </div>
        
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.elevatezoom.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-ui.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.formstyler.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/script.js"></script>
        <script>
            $(function() {
                $('.styler, /*input[type="checkbox"],*/ .form input').styler();
            });
        </script>

            <?/**
             * Тут работаем с зумом, вероятно подключение и обработку скрипта надо будет выносить под условие "если это можно"
             */?>
    </body>
</html>