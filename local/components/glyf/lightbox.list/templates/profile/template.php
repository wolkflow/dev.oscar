<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div id="js-lightboxes-block-id" class="cabinet-block cabinet-block-lightboxes is-active clearfix">
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__title">Сборники</div>
        <div class="cabinet-panel__menu">
            <a class="js-dependence-chekbox-button" href="javascript:void(0)">сохранить пдф</a>
            <a class="js-dependence-chekbox-button" href="javascript:void(0)">отправить по email</a>
            <a class="hidden-sm js-dependence-chekbox-button" href="javascript:void(0)">печать</a>
            <a id="js-personal-lightbox-basket-id" class="js-dependence-chekbox-button" href="javascript:void(0)">добавить в корзину</a>
            <a class="js-dependence-chekbox-button le-lightbox-trigger" href="javascript:void(0)">переименовать</a>
            <a id="js-personal-lightbox-delete-id" class="js-dependence-chekbox-button" href="javascript:void(0)">
                удалить
            </a>
        </div>
    </div>
    <div id="js-porfile-lightboxes-wrapper-id">
        <?  //Сборники.					
            $APPLICATION->IncludeComponent(
                "glyf:lightbox.list",
                "profile-remote",
                array()
            );
        ?>
        <? /*
        <div class="cabinet-lightboxes-list clearfix">
            <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
                <div class="cabinet-lightbox js-lightbox-wrap js-lightbox" data-lid="<?= $item['ID'] ?>">
                    <div class="cabinet-lightbox__title clearfix">
                        <span>
                            <div class="le-lightbox-edit">
                                <span class="le-lightbox-name">
                                    <input type="text" name="" data-le="lightbox-name-<?= $item['ID'] ?>" class="le disabled" value="<?= $item['UF_TITLE'] ?>" disabled placeholder="Введите название"/>
                                    <a href="javascript:void(0)" class="le le-end disabled" data-le="lightbox-name-<?= $item['ID'] ?>">OK</a>

                                    <? // Служебные линки, отмена редактирования и внесение правок ?>
                                    <a href="javascript:void(0)" class="le le-end le-cancel" data-le="lightbox-name-<?= $item['ID'] ?>"></a>
                                    <a href="javascript:void(0)" class="le le-start hide" data-le="lightbox-name-<?= $item['ID'] ?>"></a>
                                </span>
                                <span class="le le-start" data-le="lightbox-name-<?= $item['ID'] ?>">
                                    <label class="checkbox-me">
                                        <input type="checkbox" name="LIGHTBOX[]" class="js-personal-lightbox" value="<?= $item['ID']?>" /><span></span>
                                    </label>
                                </span>
                            </div>
                        </span>
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
                    <div class="le disabled" data-le="lightbox_new">
                        <div class="newLightboxForm-field">
                            <div class="cabinet-profile__block-field-value">
                                <input type="text" name="title" class="le" data-le="lightbox_new" value="" placeholder="Введите название" />
                            </div>
                        </div>
                    </div>
                    <div class="cabinet-lightbox__new">
                        <a href="javascript:void(0)" data-le="lightbox_new" class="le le-start">+</a>
                        <a class="btn btn-light btn-filter_edit le le-end disabled" href="javascript:void(0)" data-le="lightbox_new" data-action="create-lightbox" data-callback="cCreateLightbox">Сохранить</a>
                        <a class="btn btn-light btn-filter_edit le le-end le-cancel disabled" href="javascript:void(0)" data-le="lightbox_new">Отменить</a>
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
        <? /*
        <div class="cabinet-pagination">
            <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
            <div class="cabinet-pagination__buttons">
                <a href="#" class="cabinet-pagination__button cabinet-pagination__button--prev disable">&lsaquo;</a>
                <a href="#" class="cabinet-pagination__button cabinet-pagination__button--next">&rsaquo;</a>
            </div>
        </div>
        */ ?>
    </div>
</div>
