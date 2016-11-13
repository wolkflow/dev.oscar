<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-md-3 col-sm-3 hidden-xs">
    <div class="sidebarRight">
        <div class="sidebarRightTitle">
            Сборники
        </div>
        <? if (CUser::IsAuthorized()) { ?>

            <div class="lightboxes">
                <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
                    <div id="js-side-lightbox-<?= $item['ID'] ?>-id" class="lightboxes__item js-lightbox" data-lid="<?= $item['ID'] ?>">
                        <div class="lightboxes__item-title is-expanded" data-collapse-target="lightbox-<?= $item['ID'] ?>">
                            <?= $item['UF_TITLE'] ?>
                        </div>
                        <div class="lightboxes__item-content" data-collapse-block="lightbox-<?= $item['ID'] ?>">
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
                                        <a href="/personal/lightbox/<?= $lightbox['ID'] ?>/">ПЕРЕЙТИ</a>
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
        <? } else { ?>
            <div>
                Для создания сборников вам необходимо авторизоваться.
            </div>
        <? } ?>
    </div>
</div>