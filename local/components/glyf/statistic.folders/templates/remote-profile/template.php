<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\Folder; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="cabinet-collections">
        <? foreach ($arResult['ITEMS'] as $item) { ?>
            <div class="cabinet-collections__item">
                <label class="checkbox-me">
                    <input type="checkbox" class="js-checkbox" name="FIDS[]" value="<?= $item[Folder::FIELD_ID] ?>" />
                    <span></span>
                </label>
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_folder.png" />
                <a href="/personal/folders/<?= $item[Folder::FIELD_ID] ?>/">
                    <span><?= $item[Folder::FIELD_TITLE] ?></span>
                </a>
            </div>
        <? } ?>
    </div>
    <?  // Постраничная навигация.
        $APPLICATION->IncludeComponent(
            "glyf:pagenavigation",
            "gray",
            array(
                'JSID'    => 'js-folders-nav-id',
                'TOTAL'   => $arResult['TOTAL'],
                'PERPAGE' => $arParams['PERPAGE'],
                'CURRENT' => $arParams['PAGE'],
            )
        );
    ?>
<? } ?>