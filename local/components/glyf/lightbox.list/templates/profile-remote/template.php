<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div class="cabinet-lightboxes-list clearfix">
    <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
        <div class="cabinet-lightbox js-lightbox-wrap js-lightbox js-lightbox-<?= $item['ID'] ?>" data-lid="<?= $item['ID'] ?>">
            <div class="cabinet-lightbox__title clearfix">
                <span>
                    <div class="le-lightbox-edit">
                        <span class="le-lightbox-name-<?= $item['ID'] ?>">
                            <input type="hidden" name="lid" data-le="lightbox-name-<?= $item['ID'] ?>" value="<?= $item['ID'] ?>" />
                            <input type="text" name="title" data-le="lightbox-name-<?= $item['ID'] ?>" class="le disabled" value="<?= $item['UF_TITLE'] ?>" disabled placeholder="<?= getMessage('GL_ENTER_THE_NAME') ?>"/>
                            <a href="javascript:void(0)" class="le le-end disabled" data-le="lightbox-name-<?= $item['ID'] ?>" data-action="lightbox-change" data-callback="cLightboxChange">OK</a>

                            <? // Служебные линки, отмена редактирования и внесение правок ?>
                            <a href="javascript:void(0)" class="le le-start hide" data-le="lightbox-name-<?= $item['ID'] ?>"></a>
                        </span>
                        <span class="le le-start" data-le="lightbox-name-<?= $item['ID'] ?>">
                            <label class="checkbox-me">
                                <input type="checkbox" name="LIDS[]" class="js-personal-lightbox js-checkbox" value="<?= $item['ID'] ?>" />
                                <span></span>
                            </label>
                        </span>
                    </div>
                </span>
                <? /*
                <span>
                    <?= $item['UF_TITLE'] ?>
                </span>
                <label>
                    <input type="checkbox" name="LIGHTBOX[]" class="js-personal-lightbox" value="<?= $item['ID']?>" />
                </label>
                */ ?>
            </div>
            <div class="cabinet-lightbox__content">
                <div class="lightboxes__item-pictures js-lightbox-pictures">
                    <? if (!empty($item['PICTURES'])) { ?>
                        <? $chunks = array_chunk($item['PICTURES'], 3) ?>
                        <? foreach ($chunks as $chunk) { ?>
                            <div class="lightboxes__item-pictures-row">
                                <? foreach ($chunk as $picture) { ?>
                                    <div class="lightboxes__item-pictures-col">
                                        <a href="/collections/<?= $picture->getID() ?>/">
                                            <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" />
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
    
    <div class="cabinet-lightbox cabinet-lightbox--new newLightboxForm">
        <div class="cabinet-lightbox__title clearfix">
            <span><?= getMessage('GL_TO_CREATE_A_NEW') ?></span>
            <span class="plus">+</span>
        </div>
        <div class="cabinet-lightbox__content">
            <div class="le disabled" data-le="lightbox">
                <div class="newLightboxForm-field">
                    <div class="cabinet-profile__block-field-value">
                        <input type="text" name="title" class="le" data-le="lightbox" value="" placeholder="<?= getMessage('GL_ENTER_THE_NAME') ?>" />
                    </div>
                </div>
            </div>
            <div class="cabinet-lightbox__new">
                <a href="javascript:void(0)" data-le="lightbox" class="le le-start">+</a>
                <a class="btn btn-light btn-filter_edit le le-end disabled" href="javascript:void(0)" data-le="lightbox" data-action="create-lightbox" data-callback="cLightboxCreate"><?= getMessage('GL_SAVE') ?></a>
                <a class="btn btn-light btn-filter_edit le le-end le-cancel disabled" href="javascript:void(0)" data-le="lightbox"><?= getMessage('GL_CANCEL') ?></a>
            </div>
        </div>
    </div>
</div>

<?  // Постраничная навигация.
    $APPLICATION->IncludeComponent(
        "glyf:pagenavigation",
        "dark",
        array(
            'JSID'    => 'js-personal-lightboxes-id',
            'TOTAL'   => $arResult['LIGHTBOXES_COUNT'],
            'PERPAGE' => $arParams['LIMIT'],
            'CURRENT' => 1,
            'SHORT'   => true,
        )
    );
?>