<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
    <div class="buyoutBlockTitle buyoutBlockTitle-display_block">
        <div class="buyoutBlockTitleText">
            <?= getMessage('GL_CHOSEN_PICTURES') ?>
        </div>
        <a class="buyoutBlockTitleLink" href="javascript:void(0)" id="js-buyout-delete-id"><?= getMessage('GL_DELETE') ?></a>
    </div>
    <div id="js-delays-pictures-wrapper-id">
        <? if (!empty($arResult['ITEMS']['DelDelCanBuy'])) { ?>
            <ul class="buyoutBlockList">
                <? foreach ($arResult['ITEMS']['DelDelCanBuy'] as $item) { ?>
                    <? $picture = new Picture($item['PRODUCT_ID']); ?>
                    <li id="js-delay-<?= $item['ID'] ?>-id">
                        <div class="buyoutBlockListImage">
                            <label class="js-buyout-item" data-bid="<?= $item['ID'] ?>" data-pid="<?= $picture->getID() ?>">
                                <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" />
                            </label>
                        </div>
                        <div class="buyoutBlockListCheckbox">
                            <label class="checkbox-me">
                                <input type="checkbox" class="js-buyout-picture" id="js-buyout-picture-<?= $picture->getID() ?>-id" value="<?= $item['ID'] ?>" />
                                <span></span>
                            </label>
                        </div>
                    </li>
                <? } ?>
            </ul>
        </div>
    <? } else { ?>
        <div class="basket-note"><?= getMessage('GL_NO_CHOSEN_PICTURES') ?></div>
    <? } ?>
</div>
<div class="clearfix visible-xs"></div>