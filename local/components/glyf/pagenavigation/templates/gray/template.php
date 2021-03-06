<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="<?= $arResult['JSID'] ?>" class="cabinet-pagination hidden-xs" data-count="<?= $arResult['COUNT'] ?>">
	<div class="cabinet-pagination__count">
        <span class="current">
            <?= $arResult['CURRENT'] ?>
        </span> 
		<?= getMessage('GL_FROM') ?>
		<?= $arResult['COUNT'] ?>
	</div>
	<div class="cabinet-pagination__buttons">
		<a href="javascript:void(0)" class="cabinet-pagination__button cabinet-pagination__button--prev js-page js-prev" data-page="<?= $arResult['PREV'] ?>">
            &lsaquo;
        </a>
		<a href="javascript:void(0)" class="cabinet-pagination__button cabinet-pagination__button--next js-page js-next <?= ($arResult['CURRENT'] < $arResult['COUNT']) ? ('is-active') : ('') ?>" data-page="<?= $arResult['NEXT'] ?>">
            &rsaquo;
        </a>
	</div>
</div>