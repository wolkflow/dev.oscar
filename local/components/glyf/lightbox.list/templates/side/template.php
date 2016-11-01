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
        <div class="lightboxes">
            <? foreach ($arResult['LIGHTBOXES'] as $item) { ?>
                <div class="lightboxes__item">
                    <div class="lightboxes__item-title is-expanded">
                        <?= $item['UF_TITLE'] ?>
                    </div>
                    <div class="lightboxes__item-content">
                        <div class="lightboxes__item-pictures">
                            <div class="lightboxes__item-pictures-row">
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="lightboxes__item-pictures-row">
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                                <div class="lightboxes__item-pictures-col">
                                    <a href="#">
                                        <img src="images/horse.png" alt="">
                                    </a>
                                </div>
                            </div>
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