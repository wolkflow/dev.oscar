<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Персональная статистика"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain page-cabinet">
    <? if (CUser::IsAuthorized()) { ?>
        <? $user = new Glyf\Oscar\User() ?>
        
        <? if ($user->isPartner()) { ?>
            <div class="cabinet-menu">
                <a class="is-active" href="/personal/">общие сведения пользователя</a>
                <a href="/personal/catalog/">каталог</a>
            </div>
        <? } ?>
        
        <div class="container">
            <div class="row cabinet-stats">
                <div class="col-md-9 col-sm-9">
                    <ol class="breadcrumb">
                        <li><a href="/personal/">Личный кабинет</a></li>
                    </ol>
                </div>
                <?	// Профиль.					
                    $APPLICATION->IncludeComponent(
                        "glyf:user.profile",
                        "profile",
                        array()
                    );
                ?>
                <div class="col-md-9 col-sm-9">
                    <div class="cabinet-content">
                        <? if ($user->isPartner()) { ?>
                            
                            <?	// Статистика.					
                                $APPLICATION->IncludeComponent(
                                    "glyf:statistic.common",
                                    "profile",
                                    array()
                                );
                            ?>
                            
                            <div class="cabinet-block cabinet-block-history is-active">
                                <div class="clearfix">
                                    <div class="cabinet-search">
                                        <span class="cabinet-search__title">поиск по продажам</span>
                                        <div class="cabinet-search__form">
                                            <input type="text"/>
                                        </div>
                                    </div>
                                    <div class="cabinet-search">
                                        <span class="cabinet-search__title">выбрать период</span>
                                        <div class="cabinet-search__form">
                                            <input type="text" value="15.07.2016 - 17.07.2016"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet-panel cabinet-panel--switch clearfix">
                                    <div class="cabinet-panel__switch">
                                        <span class="is-active" data-block="history">История продаж</span>
                                        <span data-block="statistics">Статистика просмотров/продаж</span>
                                    </div>
                                    <div class="cabinet-panel__toggler">История продаж</div>
                                    <div class="cabinet-panel__menu">
                                        <a class="is-active" href="#">выделить всё</a>
                                        <a class="hidden-sm" href="#">сохранить пдф</a>
                                        <a class="is-active" href="#">отправить по email</a>
                                        <a class="is-active hidden-sm" href="#">печать</a>
                                        <div class="cabinet-panel__menu-pages hidden-xs">
                                            <span>показывать по</span>
                                            <select name="" id="" class="styler shortSelect cabinet-panel__menu-pages-select">
                                                <option value="30">30</option>
                                                <option value="60">60</option>
                                                <option value="90">90</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet-block-content">
                                    <table class="cabinet-table hidden-xs">
                                        <thead>
                                        <tr><th></th>
                                        <th class="has-sort">ID<span class="cabinet-table__sort"></span></th>
                                        <th class="has-sort">Название<span class="cabinet-table__sort"></th>
                                        <th class="has-sort">Цена (руб)<span class="cabinet-table__sort"></th>
                                        <th class="has-sort">Дата<span class="cabinet-table__sort"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td>6 543</td>
                                            <td>23.07.2016</td>
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td>6 543</td>
                                            <td>23.07.2016</td>
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td>6 543</td>
                                            <td>23.07.2016</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="cabinet-pagination hidden-xs">
                                        <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                                        <div class="cabinet-pagination__buttons">
                                            <div class="cabinet-pagination__button cabinet-pagination__button--prev">&lsaquo;</div>
                                            <div class="cabinet-pagination__button cabinet-pagination__button--next is-active">&rsaquo;</div>
                                        </div>
                                    </div>
                                    <div class="cabinet-table-mobile">
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Цена (руб):</span>
                                                    <span>23 003</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Цена (руб):</span>
                                                    <span>23 003</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Цена (руб):</span>
                                                    <span>23 003</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__load">
                                            <a href="#" class="btn btn-light btn-more_params">Еще</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <? } else { ?>
                            <?	// Сборники.					
                                $APPLICATION->IncludeComponent(
                                    "glyf:lightbox.list",
                                    "profile",
                                    array(
                                        "LIMIT" => 9
                                    )
                                );
                            ?>
                        
                        
                            <div class="cabinet-block cabinet-block-profilehistory is-active">
                                <div class="cabinet-panel clearfix">
                                    <div class="cabinet-panel__toggler">История заказов</div>
                                    <div class="cabinet-panel__title">История заказов</div>
                                    <div class="cabinet-panel__menu">
                                        <a class="is-active" href="#">выделить всё</a>
                                        <a class="hidden-sm" href="#">загрузить пдф</a>
                                        <a class="is-active" href="#">отправить по email</a>
                                        <a class="is-active hidden-sm" href="#">печать</a>
                                        <a href="#">повторить заказ</a>
                                        <div class="cabinet-panel__menu-pages hidden-xs">
                                            <span>показывать по</span>
                                            <select name="" id="" class="styler shortSelect cabinet-panel__menu-pages-select">
                                                <option value="30">30</option>
                                                <option value="60">60</option>
                                                <option value="90">90</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet-block-content">
                                    <table class="cabinet-table hidden-xs">
                                        <tbody>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td><span class="cabinet-table__graytext">лицензия:</span> Right-managed</td>
                                            <td><span class="cabinet-table__graytext">дата:</span> 23.07.2016</td>
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td><span class="cabinet-table__graytext">лицензия:</span> Right-managed</td>
                                            <td><span class="cabinet-table__graytext">дата:</span> 23.07.2016</td>
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox"></label></td>
                                            <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                                            <td>№ 1234567</td>
                                            <td>Поль Гоген, "Женщина, держащая плод" 1893г.</td>
                                            <td><span class="cabinet-table__graytext">лицензия:</span> Right-managed</td>
                                            <td><span class="cabinet-table__graytext">дата:</span> 23.07.2016</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="cabinet-pagination hidden-xs">
                                        <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                                        <div class="cabinet-pagination__buttons">
                                            <a href="#" class="cabinet-pagination__button cabinet-pagination__button--prev disable">&lsaquo;</a>
                                            <a href="#" class="cabinet-pagination__button cabinet-pagination__button--next">&rsaquo;</a>
                                        </div>
                                    </div>
                                    <div class="cabinet-table-mobile visible-xs">
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Лицензия:</span>
                                                    <span>Rights-managed</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Лицензия:</span>
                                                    <span>Rights-managed</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__item clearfix">
                                            <div class="col-xs-1">
                                                <label><input type="checkbox"></label>
                                            </div>
                                            <div class="cabinet-table-mobile__data col-xs-11">
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>№</span>
                                                    <span>1234567</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Название:</span>
                                                    <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Лицензия:</span>
                                                    <span>Rights-managed</span>
                                                </div>
                                                <div class="cabinet-table-mobile__data-row">
                                                    <span>Дата:</span>
                                                    <span>23.07.2016</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cabinet-table-mobile__load">
                                            <a href="#" class="btn btn-light btn-more_params">Еще</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    <? } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <div class="errorPage">
                        <div class="errorPageTitle">Ошибка доступа</div>
                        <div class="errorPageMessage">
                            <p>Вы не авторизованы на сайте.<br/>Для продолженя работы нажмите на ссылку "Войти"!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>