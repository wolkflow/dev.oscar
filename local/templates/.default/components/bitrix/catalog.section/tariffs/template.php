<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? \Bitrix\Main\Loader::includeModule('glyf.core') ?>

<? use Bitrix\Main\Localization\Loc; ?>
<? use Glyf\Core\Helpers\Text as TextHelper; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="container">
    <div class="tarrifs">
    <h1>
        <?= getMessage('GL_TARIFFS') ?>
    </h1>
    <div class="row">
        <div class="tariffsPretext col-lg-offset-2 col-lg-8">
            <?  // Описание тарифов.
                $APPLICATION->IncludeComponent('bitrix:main.include', '', 
                    array(
                        'AREA_FILE_SHOW' => 'file',
                        'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/tariffs.php',
                        'EDIT_TEMPLATE' => 'html'
                    ),
                    $component
                );
            ?>
        </div>
    </div>
        <div class="row">
            <? foreach ($arResult['ITEMS'] as $item) { ?>
                <div class="col-sm-4 tariffBlock">
                    <div class="tariffBlockTop">
                        <div class="tariffBlockTitle">
                            <?= $item['PROPERTIES']['LANG_TITLE_' . CURRENT_LANG_UP]['VALUE'] ?>
                        </div>
                        <p>
                            <?= $item['PROPERTIES']['LANG_TEXT_' . CURRENT_LANG_UP]['VALUE']['TEXT'] ?>
                        </p>
                    </div>
                    <div class="tariffBlockBot">
                        <? if (!empty($item['PROPERTIES']['LANG_FEATURES_' . CURRENT_LANG_UP]['VALUE'])) { ?>
                            <ul>
                                <? foreach ($item['PROPERTIES']['LANG_FEATURES_' . CURRENT_LANG_UP]['VALUE'] as $value) { ?>
                                    <li><?= $value ?></li>
                                <? } ?>
                            </ul>
                        <? } ?>
                        <div class="tariffBlockPrice">
                            <div>
                                <?= intval($item['CATALOG_PURCHASING_PRICE']) ?>
                                <?= getMessage('GL_ROUBLES_PER_MONTH') ?>
                            </div>
                            <a href="javascript:void(0)" class="buy-tariff js-buy-tariff" data-tid="<?= $item['ID'] ?>">
                                <?= getMessage('GL_BUY') ?>
                            </a>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>