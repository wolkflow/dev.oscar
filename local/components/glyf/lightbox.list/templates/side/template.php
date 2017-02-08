<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if ($arResult['USER']->isPartner()) return ?>

<div class="col-sm-3 col-lg-2"><? /* "col-md-3 col-sm-3 hidden-xs"> */ ?>
    <div class="sidebarRight">
        <div class="sidebarRightTitle">
            <?= getMessage('GL_COLLECTIONS') ?>
        </div>
        
        <? if (CUser::IsAuthorized()) { ?>
            <div class="lightboxes">
                <div id="js-side-lightboxes-id">
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
                                                        <a href="<?= $picture->getDetailURL() ?>">
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
                </div>
                <div class="lightboxes__item">
                    <div class="lightboxes__item-title is-expanded lightboxes__item-title--new"><?= getMessage('GL_TO_CREATE_A_NEW') ?></div>
                    <div class="lightboxes__item-content">
                        <div class="lightbox__new">
                            <div class="le disabled" data-le="lightbox">
                                <div class="newLightboxForm-field">
                                    <div class="cabinet-profile__block-field-value">
                                        <input type="hidden" name="onside" data-le="lightbox" value="Y" />
                                        <input type="text" name="title" class="le" data-le="lightbox" id="js-lightbox-input-title-id" value="" placeholder="<?= getMessage('GL_INPUT_TITLE') ?>" />
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" data-le="lightbox" class="sideAddLightbox le le-start">+</a>
                            <a class="btn btn-light btn-filter_edit le le-end disabled" href="javascript:void(0)" data-le="lightbox" data-action="create-lightbox" data-callprev="cLightboxSideBeforeCreate" data-callback="cLightboxSideCreate"><?= getMessage('GL_SAVE') ?></a>
                            <a class="btn btn-light btn-filter_edit le le-end le-cancel disabled" href="javascript:void(0)" data-le="lightbox"><?= getMessage('GL_CANCEL') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <? } else { ?>
            <div>
                <?= getMessage('GL_COLLECTIONS_LOG_IN') ?>
            </div>
        <? } ?>
    </div>
</div>