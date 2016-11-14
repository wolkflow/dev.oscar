<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['LIGHTBOX'])) { ?>
    
    <ol class="breadcrumb">
        <li><a href="/personal/">Профиль</a></li>
        <li><?= $arResult['LIGHTBOX']['UF_TITLE'] ?></li>
    </ol>
    
    <div class="cabinet-panel clearfix">
        <div class="cabinet-panel__switch">
            <span class="is-active">
                <?= $arResult['LIGHTBOX']['UF_TITLE'] ?>
            </span>
        </div>
        <div class="cabinet-panel__toggler">Коллекции</div>
        <div class="cabinet-panel__menu">
            <a class="js-dependence-chekbox-button" href="#">сохранить пдф</a>
            <a class="js-dependence-chekbox-button" href="#">отправить по email</a>
            <a class="js-dependence-chekbox-button" href="#">печать</a>
            <a class="js-dependence-chekbox-button" href="javascript:void(0)" id="js-add-list-to-cart-id">
                Добавить в корзину
            </a>
            <a class="js-dependence-chekbox-button" href="javascript:void(0)" id="js-remove-list-from-lightbox-id" data-lid="<?= $arResult['LIGHTBOX']['ID'] ?>">
                удалить
            </a>
        </div>
    </div>

    <div class="lightboxes-set" id="js-lightbox-pictures-wrapper-id" data-lid="<?= $arResult['LIGHTBOX']['ID'] ?>">
        <? if (!empty($arResult['ITEMS'])) { ?>
            <div class="row">
                <? foreach ($arResult['ITEMS'] as $item) { ?>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                        <div class="lightboxes-setImage">
                            <img src="<?= CFile::getPath($item[Picture::FIELD_SMALL_FILE]) ?>" />
                        </div>
                        <div class="lightboxes-setAction">
                            <input type="checkbox" class="js-picture-item-checkbox" value="<?= $item[Picture::FIELD_ID] ?>" />
                            <div class="lightboxes-setAction-buttons">
                                <? if ($item[Picture::FIELD_LEGAL] == Picture::PROP_LEGAL_FULL_ID) { ?>
                                    <a class="card-image__button card-image__button--copyright" href="javascript:void(0)"></a>
                                <? } ?>
                                <a class="card-image__button card-image__button--cart js-add-to-cart" href="javascript:void(0)" data-pid="<?= $item[Picture::FIELD_ID] ?>"></a>
                            </div>
                        </div>
                        <div class="lightboxes-setTitle">
                            <?= $item[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                        </div>
                        <div class="lightboxes-setDesc">
                            <?= $item['AUTHOR'] ?>
                        </div>
                    </div>
                <? } ?>
                <div class="clearfix visible-xs"></div>
                <div class="clearfix visible-lg-block"></div>
            </div>
            <div class="row">
                <div class="cabinet-pagination hidden-xs">
                    <?  // Постраничная навигация
                        $APPLICATION->IncludeComponent(
                            "glyf:pagenavigation",
                            "gray",
                            array(
                                'JSID'    => 'js-lightbox-pictures-nav-id',
                                'TOTAL'   => $arResult['TOTAL'],
                                'PERPAGE' => StatisticFolderDetail::PERPAGE,
                                'CURRENT' => $arParams['PAGE'],
                            )
                        );
                    ?>
                </div>
            </div>
        <? } else { ?>
            <div class="lightbox-empty">
                <?= getMessage('GL_LAIGHTBOX_PICTURES_NO_FOUND') ?>
            </div>
        <? } ?>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_LAIGHTBOX_NO_FOUND') ?></p>
<? } ?>