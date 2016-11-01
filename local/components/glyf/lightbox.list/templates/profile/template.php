<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div class="cabinet-block cabinet-block-lightboxes is-active hidden-xs clearfix">
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__title">Сборники</div>
        <div class="cabinet-panel__menu">
            <a class="is-active" href="#">сохранить пдф</a>
            <a class="is-active" href="#">отправить по email</a>
            <a class="hidden-sm" href="#">печать</a>
            <a href="#">добавить в корзину</a>
            <a class="is-active" href="#">переименовать</a>
            <a class="is-active" href="#">удалить</a>
        </div>
    </div>
    <div class="cabinet-lightboxes-list clearfix">
        <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
            <div class="cabinet-lightbox">
                <div class="cabinet-lightbox__title clearfix">
                    <span>
                        <?= $item['UF_TITLE'] ?>
                    </span>
                    <label>
                        <input type="checkbox" name="LIGHTBOX[]" value="<?= $item['ID']?>" />
                    </label>
                </div>
                <div class="cabinet-lightbox__content">
                    <div class="lightboxes__item-pictures">
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
                                <a href="/personal/lightboxes/<?= $lightbox['ID'] ?>/">ПЕРЕЙТИ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
        
        <div class="cabinet-lightbox cabinet-lightbox--new">
            <div class="cabinet-lightbox__title clearfix">
                <span>Создать новый</span>
                <span class="plus">+</span>
            </div>
            <div class="cabinet-lightbox__content">
                <div class="cabinet-lightbox__new">
                    <a href="#">+</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="cabinet-pagination">
        <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
        <div class="cabinet-pagination__buttons">
            <a href="#" class="cabinet-pagination__button cabinet-pagination__button--prev disable">&lsaquo;</a>
            <a href="#" class="cabinet-pagination__button cabinet-pagination__button--next">&rsaquo;</a>
        </div>
    </div>
</div>

<? /*
<div class="col-md-3 col-sm-3 hidden-xs">
    <div class="sidebarRight">
        <div class="sidebarRightTitle">
            Сборники
        </div>
        <div class="lightboxes">
            <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
                <div class="lightboxes__item">
                    <div class="lightboxes__item-title is-expanded" data-collapse-target="lightbox-<?= $item['ID'] ?>">
                        <?= $item['UF_TITLE'] ?>
                    </div>
                    <div class="lightboxes__item-content" data-collapse-block="lightbox-<?= $item['ID'] ?>">
                        <div class="lightboxes__item-pictures">
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
                        </div>
                        <div class="lightboxes__item-bottom">
                            <div class="row">
                                <div class="col-sm-6 lightboxes__item-bottom-count">
                                    <?= $item['COUNT'] ?>
                                </div>
                                <div class="col-sm-6 lightboxes__item-bottom-link">
                                    <a href="/personal/lightboxes/<?= $lightbox['ID'] ?>/">ПЕРЕЙТИ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
            
            <div class="lightboxes__item">
                <div class="lightboxes__item-title is-expanded lightboxes__item-title--new">Создать новый</div>
                <div class="lightboxes__item-content">
                    <span class="lightboxes__item-new">Перетащите изображения сюда, чтобы добавить в лайтбокс</span>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>