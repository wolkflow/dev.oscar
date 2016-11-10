<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
    <div class="buyoutBlockTitle buyoutBlockTitle-display_block">
        <div class="buyoutBlockTitleText">выбранные изображения</div>
        <a class="buyoutBlockTitleLink" href="javascript:void(0)" id="js-buyout-delete-id">удалить</a>
    </div>
    <div id="js-buyout-pictures-wrapper-id">
        <? if (!empty($arResult['ITEMS']['DelDelCanBuy'])) { ?>
            <ul class="buyoutBlockList">
                <? foreach ($arResult['ITEMS']['DelDelCanBuy'] as $item) { ?>
                    <? $picture = new Picture($item['PRODUCT_ID']); ?>
                    <li id="js-cart-<?= $item['ID'] ?>-id">
                        <div class="buyoutBlockListImage">
                            <label class="js-buyout-item" data-bid="<?= $item['ID'] ?>" data-pid="<?= $picture->getID() ?>">
                                <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" />
                            </label>
                        </div>
                        <div class="buyoutBlockListCheckbox">
                            <input type="checkbox" class="js-buyout-picture" id="js-buyout-picture-<?= $picture->getID() ?>-id" value="<?= $item['ID'] ?>" />
                        </div>
                    </li>
                <? } ?>
            </ul>
            <? /*
            <div class="cabinet-pagination hidden-xs">
                <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                <div class="cabinet-pagination__buttons">
                    <div class="cabinet-pagination__button cabinet-pagination__button--prev">&lsaquo;</div>
                    <div class="cabinet-pagination__button cabinet-pagination__button--next is-active">&rsaquo;</div>
                </div>
            </div>
            */ ?>
        </div>
    <? } ?>
</div>
<div class="clearfix visible-xs"></div>