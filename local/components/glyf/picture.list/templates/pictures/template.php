<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-9 col-lg-8">
    <? if (!empty($arResult['ITEMS'])) { ?>
        <div class="row">
            <? foreach ($arResult['ITEMS'] as $item) { ?>
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 catalogItem-alt">
                    <a href="<?= $item['DETAIL_URL'] ?>">
                        <div class="catalogItemImage-alt" style="background-image: url(<?= CFile::getPath($item[Picture::FIELD_SMALL_FILE]) ?>"></div>
                    </a>
                    <div class="catalogItemTitle-alt">
                        <a href="<?= $item['COLLECTION']['SECTION_PAGE_URL'] ?>">
                            <?= $item['COLLECTION']['UF_LANG_TITLE_' . CURRENT_LANG_UP] ?>
                        </a>
                        <div class="card-image__buttons catalog-image__buttons">
                            <? if ($item[Picture::FIELD_LEGAL] == Picture::PROP_LEGAL_FULL_ID) { ?>
                                <a class="card-image__button card-image__button--copyright" href="javascript:void(0)" title="<?= getMessage('GL_NON_COMMERCIAL') ?>"></a>
                            <? } ?>
                            <a class="card-image__button card-image__button--add js-add-to-lightbox" href="javascript:void(0)" data-pid="<?= $item[Picture::FIELD_ID] ?>"></a>
                            <a class="card-image__button card-image__button--cart js-add-to-cart" href="javascript:void(0)" data-pid="<?= $item[Picture::FIELD_ID] ?>"></a>
                        </div>
                    </div>
                    <div class="catalogItemDesc-alt">
                        <?= $item[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                    </div>
                </div>
            <? } ?>
        </div>
    <? } else { ?>
        <p><?= getMessage('GL_NO_FOUND') ?></p>
    <? } ?>
</div>