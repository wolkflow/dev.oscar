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
			
            <div class="modal modal-login" id="modal-register">
                <div class="modalTitle">
                    Регистрация
                    <div class="modalClose arcticmodal-close"></div>
                </div>
                <div class="modalContent">
                    <form action="" class="form">
                        <ul class="formList">
                            <li>
                                <label for="regname">Имя</label>
                                <input type="text" id="regname">
                            </li>
                            <li>
                                <label for="regorg">Организация *</label>
                                <input type="text" id="regorg">
                            </li>
                            <li>
                                <label for="regpos">Должность *</label>
                                <input type="text" id="regpos">
                            </li>
                            <li>
                                <label for="regmail">Email</label>
                                <input type="text" id="regmail">
                            </li>
                            <li class="reginfo"><span>*</span> поля заполняются в случае, если пользователь выступает от имени организации</li>
                            <li>
                                <label for="regpass">Пароль</label>
                                <input type="text" id="regpass">
                            </li>
                            <li>
                                <label for="regpassre">Повторить пароль</label>
                                <input type="text" id="regpassre">
                            </li>
                            <li class="reginfo">
                                <label for="regacept"><input type="checkbox" id="regacept"> Согласен с <a href="#">договором оферты</a></label>
                            </li>
                            <li>
                                <input type="submit" value="ОК" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.formstyler.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.arcticmodal.min.js"></script>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/script.js"></script>
        <script>
            $(function() {
                $('.styler, input[type=checkbox]').styler();
            });
        </script>
    </body>
</html>