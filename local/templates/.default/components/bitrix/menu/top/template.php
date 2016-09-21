<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $this->setFrameMode(true) ?>

<? if (!empty($arResult)) { ?>
	<ul class="nav main-menu">
		<? foreach ($arResult as $arItem) { ?>
			<li>
				<a href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?></a>
			</li>
		<? } ?>
	</ul>
<? } ?>