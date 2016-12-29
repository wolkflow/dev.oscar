<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['FOLDER'])) { ?>
    <? foreach ($arResult['ITEMS'] as $item) { ?>
        <tr>
            <td>
                <label class="checkbox-me">
                    <input type="checkbox" name="PIDS[]" value="<?= $item[Picture::FIELD_ID] ?>" class="js-checkbox" />
                    <span></span>
                </label>
            </td>
            <td>
                № <?= $item['VIEWID'] ?>
            </td>
            <td>
                <?= $item[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
            </td>
            <td>
                <? if ($item[Picture::FIELD_MODERATE]) { ?>
                    <?= date('d.m.Y', strtotime($item[Picture::FIELD_MODERATE_TIME])) ?>
                <? } else { ?>
                    <span class="cabinet-table__bluetext">Модерация</span>
                <? } ?>
            </td>
            <td>
                <?= number_format($item[Picture::FIELD_STAT_VIEWS], 0, '.' , ' ') ?>
            </td>
            <td>
                <?= number_format($item[Picture::FIELD_STAT_SALES], 0, '.' , ' ') ?>
            </td>
        </tr>
    <? } ?>
    <tr class="separate">
        <td colspan="6">
            <?  // Постраничная навигация
                $APPLICATION->IncludeComponent(
                    "glyf:pagenavigation",
                    "gray",
                    array(
                        'JSID'    => 'js-folder-pictures-nav-id',
                        'TOTAL'   => $arResult['TOTAL'],
                        'PERPAGE' => $arParams['PERPAGE'],
                        'CURRENT' => $arParams['PAGE'],
                    )
                );
            ?>
        </td>
    </tr>
<? } ?>