<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="lightboxes__item-pictures js-lightbox-pictures">
    <? if (!empty($arResult['PICTURES'])) { ?>
        <? $chunks = array_chunk($arResult['PICTURES'], 3) ?>
        <? foreach ($chunks as $chunk) { ?>
            <div class="lightboxes__item-pictures-row">
                <? foreach ($chunk as $picture) { ?>
                    <div class="lightboxes__item-pictures-col">
                        <a href="/collections/<?= $picture->getID() ?>/">
                            <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" alt="<?= $picture->getTitle() ?>" />
                        </a>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    <? } else { ?>
        <div class="lightboxes__item-empty">
            <span><?= getMessage('GL_NO_NEW_IMAGE') ?></span>
        </div>
    <? } ?>
</div>
<div class="lightboxes__item-bottom">
    <div class="row">
        <div class="col-sm-6 lightboxes__item-bottom-count">
            <?= $arResult['COUNT'] ?>
        </div>
        <div class="col-sm-6 lightboxes__item-bottom-link">
            <a href="/personal/lightbox/<?= $arResult['LIGHTBOX']['ID'] ?>/">ПЕРЕЙТИ</a>
        </div>
    </div>
</div>