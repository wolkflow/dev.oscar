<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="row">
	<div class="col-sm-3 col-lg-2 sidebarLeft">
		<div class="sidebarLeftTitle formParamsTitle" data-collapse-target="formParams">
			<?= getMessage('GL_SEARCH_PARAMS') ?>
		</div>
		
		<form action="" class="form" data-collapse-block="formParams">
			<ul class="filters filtersSet">
				<li>
					<label class="filtersTitle" for="ci-title">
						<?= getMessage('GL_SEARCH_PARAM_TITLE') ?>
					</label>
					<input type="text" id="ci-title" name="F[TITLE]" value="<?= $arResult['DATA']['TITLE'] ?>" />
				</li>
				<li>
					<label class="filtersTitle" for="ci-author">
						<?= getMessage('GL_SEARCH_PARAM_AUTHOR') ?>
					</label>
					<input type="text" id="ci-author" name="F[AUTHOR]" value="<?= $arResult['DATA']['AUTHOR'] ?>" />
				</li>
				<li>
					<label class="filtersTitle" for="ci-right_holder">
						<?= getMessage('GL_SEARCH_PARAM_HOLDER') ?>
					</label>
					<input type="text" id="ci-right_holder" name="F[HOLDER]" value="<?= $arResult['DATA']['HOLDER'] ?>" />
				</li>
				<li class="ci-period-li">
					<label class="filtersTitle display-inlineBlock" for="ci-period">
						<?= getMessage('GL_SEARCH_PARAM_PERIOD') ?>
					</label>
					<label class="label-radio"><input type="radio" name="ci-period" id="ci-period" class="styler" checked> Год</label>
					<label class="label-radio"><input type="radio" name="ci-period" class="styler"> Век</label>
					<div class="periodSelect">
						<div class="periodSelect_first">
							<input type="text" placeholder="От">
							<select class="styler">
								<option value="ДНЭ">ДНЭ</option>
								<option value="НЭ">НЭ</option>
							</select>
						</div>
						<div class="periodSelect_second">
							<input type="text" placeholder="До">
							<select class="styler">
								<option value="НЭ">НЭ</option>
								<option value="ДНЭ">ДНЭ</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<label class="filtersTitle" for="ci-right_technique">
						<?= getMessage('GL_SEARCH_PARAM_TECHNIQUE') ?>
					</label>
					<input type="text" id="ci-right_technique">
				</li>
				<li>
					<label class="filtersTitle" for="ci-right_id">
						<?= getMessage('GL_SEARCH_PARAM_ID') ?>
					</label>
					<input type="text" id="ci-right_id">
				</li>
				<li>
					<label class="filtersTitle" for="ci-right_keywords">
						<?= getMessage('GL_SEARCH_PARAM_KEYWORDS') ?>
					</label>
					<input type="text" id="ci-right_keywords">
				</li>
				<li>
					<input type="submit" class="btn btn-find" value="<?= getMessage('GL_SEARCH_BUTTON_SUBMIT') ?>" />
				</li>
			</ul>
		</form>
		
		<div class="sidebarLeftTitle" data-collapse-target="formFilters">
			<?= getMessage('GL_SEARCH_FILTERS') ?>
		</div>
		<form action="" data-collapse-block="formFilters">
			<div class="filterBlock shortParamsSet filterBlock-type">
				<div class="filterBlockTitle">Тип объекта</div>
				<ul>
					<li><label><input type="checkbox"> Живопись</label></li>
					<li><label><input type="checkbox"> Графика</label></li>
					<li class="disabled"><label><input type="checkbox" disabled> Скульптура</label></li>
					<li><label><input type="checkbox"> Декоративно-прикладное искусство</label></li>
				</ul>
				<a href="#" class="btn btn-light btn-more_params">Еще</a>
			</div>
			<div class="filterBlock shortParamsSet filterBlock-genre">
				<div class="filterBlockTitle">жанр</div>
				<ul>
					<li><label><input type="checkbox"> автопортрет</label></li>
					<li><label><input type="checkbox"> анимализм</label></li>
					<li class="disabled"><label><input type="checkbox" disabled> батальный</label></li>
					<li><label><input type="checkbox"> былмнный</label></li>
				</ul>
				<a href="#" class="btn btn-light btn-more_params">Еще</a>
			</div>
			<ul class="filters">
				<li>
					<label class="filtersTitle" for="ci-place_cr">Место создания</label>
					<input type="text" id="ci-place_cr">
				</li>
				<li class="filterBlock filterBlock-size">
					<label class="filtersTitle" for="ci-size_first">Размер объекта (мм)</label>
					<input type="text" class="input-size pull-left" id="ci-size_first" placeholder="От">
					<input type="text" class="input-size pull-right" id="ci-size_second" placeholder="До">
					<span class="ci-divider"></span>
				</li>
				<li class="filterBlock filterBlock-color">
					<label class="filtersTitle" for="ci-colors_colored">Цвет изображения</label>
					<ul>
						<li><label><input type="checkbox" id="ci-colors_colored"> Цветное</label></li>
						<li><label><input type="checkbox"> Черно-белое</label></li>
					</ul>
				</li>
				<li class="filterBlock filterBlock-right">
					<label class="filtersTitle" for="ci-right-pack">Правовой режим</label>
					<ul>
						<li><label><input type="checkbox" id="ci-right-pack"> Полный пакет</label></li>
						<li><label><input type="checkbox"> Только некоммерческое использование</label></li>
					</ul>
				</li>
			</ul>
		</form>
		<div class="filterSave">
			<a href="#" class="btn btn-filter_save" data-collapse-target="searchSave">сохранить поиск</a>
			<div class="filterSaveInner" data-collapse-block="searchSave">
				<ul>
					<li><a href="#">Поиск №1</a></li>
					<li><a href="#">Поиск №2</a></li>
					<li><a href="#">Поиск №356</a></li>
					<li><a href="#">Поиск №41331</a></li>
					<li><a href="#">Поиск №5</a></li>
				</ul>
				<a href="#" class="btn btn-light btn-filter_edit">Редактировать</a>
				<a href="#" class="btn btn-light btn-filter_delete">Удалить все</a>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-lg-10">
		<div class="row">
			<div class="col-sm-4 col-lg-3 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage.png)"></div>
					<div class="catalogItemTitle">Живопись</div>
					<div class="catmark">23 498</div>
				</a>
			</div>
			<div class="col-sm-8 col-lg-5 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage1.png)"></div>
					<div class="catalogItemTitle">декоративно-прикладное искусство</div>
					<div class="catmark">23 498</div>
				</a>
			</div>
			<div class="col-sm-8 col-lg-4 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage2.png)"></div>
					<div class="catalogItemTitle">современноеискусство</div>
					<div class="catmark">234 498</div>
				</a>
			</div>
			<div class="col-sm-4 col-lg-4 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage3.png)"></div>
					<div class="catalogItemTitle">военный антиквариат</div>
					<div class="catmark">2198</div>
				</a>
			</div>
			<div class="col-sm-4 col-lg-3 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage4.png)"></div>
					<div class="catalogItemTitle">графика</div>
					<div class="catmark">23 498</div>
				</a>
			</div>
			<div class="col-sm-8 col-lg-5 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage5.png)"></div>
					<div class="catalogItemTitle">монеты и бумажные деньги</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-8 col-lg-5 catalogItem">
				<a href="#">
					<div class="catalogItemImage"></div>
					<div class="catalogItemTitle">технические устройства</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-4 col-lg-4 catalogItem">
				<a href="#">
					<div class="catalogItemImage"></div>
					<div class="catalogItemTitle">архитектурные детали</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-4 col-lg-3 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage6.png)"></div>
					<div class="catalogItemTitle">скульптура</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-8 col-lg-3 catalogItem">
				<a href="#">
					<div class="catalogItemImage" style="background-image: url(images/cover/catalogItemImage7.png)"></div>
					<div class="catalogItemTitle">фотография</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-5 catalogItem">
				<a href="#">
					<div class="catalogItemImage"></div>
					<div class="catalogItemTitle">памятники письменности, документы</div>
					<div class="catmark">2398</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 catalogItem">
				<a href="#">
					<div class="catalogItemImage"></div>
					<div class="catalogItemTitle">археологические памятники</div>
					<div class="catmark">2398</div>
				</a>
			</div>
		</div>
	</div>
</div>