            <div class="siteFooter">
                <div class="container">
                    <div class="row">
                        <ul class="nav navbar-cart footer-cart visible-xs">
                            <li>
                                <a href="#">
                                    <span class="cart-count">5</span>
                                    <i class="icon icon-cart"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav footer-login">
                            <li class="login">
                                <a href="#">Войти</a>
                            </li>
                            <li>
                                <a href="#">Регистрация</a>
                            </li>
                        </ul>
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
                            
                            <div class="row">
                                <div class="col-xs-11 col-xs-offset-1 col-sm-12 col-sm-offset-0">
                                    <div class="siteFooterContacts">
                                        <p class="footerContactsPhone"><span>Телефон:</span> +7 916 301 34 50</p>
                                        <p class="footerContactsMail"><span>Email:</span> office@OscarArtAgency.ru</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="copyright">
                                2015 &copy; Арт агентство «Оскар»
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="madeby">
                                <span>Дизайн <a href="http://artideas.ru/" target="_blank">ARTIDEAS</a>.</span>
                                <span>Разработка <a href="http://wolkflow.com/" target="_blank">WOLK</a>. 2016</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide">
            <div class="modal modal-search" id="modal-search">
                <div class="modalTitle">
                    Расширенный поиск
                    <div class="modalClose arcticmodal-close"></div>
                </div>
                <div class="modalContent">
                    <form action="" class="form">
                        <ul class="formList">
                            <li>
                                <label for="sname">Название</label>
                                <input type="text" id="sname">
                            </li>
                            <li>
                                <label for="sauthor">Автор</label>
                                <input type="text" id="sauthor">
                            </li>
                            <li>
                                <label for="scopy">Правообладатель</label>
                                <input type="text" id="scopy">
                            </li>
                            <li class="ci-period-li speriod">
                                <label class="filtersTitle display-inlineBlock" for="speriod">Период</label>
                                <label class="label-radio"><input type="radio" name="speriod" id="speriod" class="styler" checked> Год</label>
                                <label class="label-radio"><input type="radio" name="speriod" class="styler"> Век</label>
                                <div class="periodSelect">
                                    <div class="periodSelect_first">
                                        <input type="text" placeholder="От">
                                        <select class="styler">
                                            <option value="ДНЭ">ДО НАШЕЙ ЭРЫ</option>
                                            <option value="НЭ">НАШЕЙ ЭРЫ</option>
                                        </select>
                                    </div>
                                    <div class="periodSelect_second">
                                        <input type="text" placeholder="До">
                                        <select class="styler">
                                            <option value="ДНЭ">ДО НАШЕЙ ЭРЫ</option>
                                            <option value="НЭ">НАШЕЙ ЭРЫ</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <label for="stech">Техника</label>
                                <input type="text" id="stech">
                            </li>
                            <li>
                                <label for="sid">Техника</label>
                                <input type="text" id="sid">
                            </li>
                            <li>
                                <label for="skeywords">Ключевые слова</label>
                                <input type="text" id="skeywords">
                            </li>
                            <li>
                                <input type="submit" value="Найти" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>

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