<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-12 col-md-8">
	<div class="partnersTopTitle">
		<h3><?= $arResult['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?></h3>
	</div>
	<div class="col-sm-6">
		<?= $arResult['TEXTS'][0] ?>
	</div>
	<div class="col-sm-6">
		<?= $arResult['TEXTS'][1] ?>
	</div>
</div>