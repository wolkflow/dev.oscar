<? define('PAGE', 'UPLOAD') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Загрузка изображения"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain page-cabinet">
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
                    
                        <?	// Сборники.					
                            $APPLICATION->IncludeComponent(
                                "glyf:lightbox.list",
                                "profile",
                                array()
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
                    
                    </div>
                </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>