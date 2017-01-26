<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if ($arResult['USER']->isPartner()) return ?>

<? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
    <div id="js-side-lightbox-<?= $item['ID'] ?>-id" class="lightboxes__item js-lightbox js-lightbox-drop <?= ($arResult['ACTIVE'] == $item['ID']) ? ('js-acitve-lightbox') : ('') ?>" data-lid="<?= $item['ID'] ?>">
        <div class="lightboxes__item-title js-lightbox-title <?= ($arResult['ACTIVE'] == $item['ID']) ? ('is-expanded') : ('') ?>" data-lid="<?= $item['ID'] ?>" data-collapse-target="lightbox-<?= $item['ID'] ?>">
            <?= $item['UF_TITLE'] ?>
        </div>
        <div class="lightboxes__item-content js-lightbox-content <?= ($arResult['ACTIVE'] == $item['ID']) ? ('') : ('collapsed') ?>" data-collapse-block="lightbox-<?= $item['ID'] ?>">
            <div class="lightboxes__item-pictures js-lightbox-pictures">
                <? if (!empty($item['PICTURES'])) { ?>
                    <? $chunks = array_chunk($item['PICTURES'], 3) ?>
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
                        <?= $item['COUNT'] ?>
                    </div>
                    <div class="col-sm-6 lightboxes__item-bottom-link">
                        <a href="/personal/lightbox/<?= $item['ID'] ?>/"><?= getMessage('GL_GO') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>
