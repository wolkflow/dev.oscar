<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Statistic\Sale; ?>
<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>
<? foreach ($arResult['ITEMS'] as $item) { ?>
    <tr>
        <td class="ordersTable-checkbox">
            <label class="checkbox-me">
                <input type="checkbox" name="IDS[]" class="js-order js-checkbox" value="<?= $item[Sale::FIELD_ID] ?>" data-oid="<?= $item[Sale::FIELD_ID] ?>" />
                <span></span>
            </label>
        </td>
        <td class="ordersTable-img">
            <img class="cabinet-table__img" src="<?= CFile::getPath($item['PICTURE'][Picture::FIELD_SMALL_FILE]) ?>" />
        </td>
        <td>
            № <?= $item[Sale::FIELD_ORDER_ID] ?>
        </td>
        <td>
            <?= $item['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
        </td>
        <td>
            <span class="cabinet-table__graytext">лицензия:</span>
            <?= $item['LICENSE'][License::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
        </td>
        <td>
            <span class="cabinet-table__graytext">дата:</span>
            <?= date('d.m.Y', strtotime($item[Sale::FIELD_TIME])) ?>
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
                    'JSID'    => 'js-orders-nav-id',
                    'TOTAL'   => $arResult['TOTAL'],
                    'PERPAGE' => $arParams['PERPAGE'],
                    'CURRENT' => $arParams['PAGE'],
                )
            );
        ?>
    </td>
</tr>