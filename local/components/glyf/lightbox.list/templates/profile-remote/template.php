<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div class="cabinet-lightboxes-list clearfix">
    <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
        <div class="cabinet-lightbox js-lightbox-wrap js-lightbox" data-lid="<?= $item['ID'] ?>">
            <div class="cabinet-lightbox__title clearfix">
                <span>
                    <?= $item['UF_TITLE'] ?>
                </span>
                <label>
                    <input type="checkbox" name="LIGHTBOX[]" class="js-personal-lightbox" value="<?= $item['ID']?>" />
                </label>
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
                            <span>вы не добавили ещё ни одного изображения</span>
                        </div>
                    <? } ?>
                </div>
                <div class="lightboxes__item-bottom">
                    <div class="row">
                        <div class="col-sm-6 lightboxes__item-bottom-count">
                            <?= $item['COUNT'] ?>
                        </div>
                        <div class="col-sm-6 lightboxes__item-bottom-link">
                            <a href="/personal/lightbox/<?= $item['ID'] ?>/">ПЕРЕЙТИ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
    
    <div class="cabinet-lightbox cabinet-lightbox--new newLightboxForm">
        <div class="cabinet-lightbox__title clearfix">
            <span>Создать новый</span>
            <span class="plus">+</span>
        </div>
        <div class="cabinet-lightbox__content">
            <div class="le disabled" data-le="lightbox">
                <div class="newLightboxForm-field">
                    <div class="cabinet-profile__block-field-value">
                        <input type="text" name="title" class="le" data-le="lightbox" value="" placeholder="Введите название" />
                    </div>
                </div>
            </div>
            <div class="cabinet-lightbox__new">
                <a href="javascript:void(0)" data-le="lightbox" class="le le-start">+</a>
                <a class="btn btn-light btn-filter_edit le le-end disabled" href="javascript:void(0)" data-le="lightbox" data-action="create-lightbox" data-callback="cCreateLightbox">Сохранить</a>
                <a class="btn btn-light btn-filter_edit le le-end le-cancel disabled" href="javascript:void(0)" data-le="lightbox">Отменить</a>
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