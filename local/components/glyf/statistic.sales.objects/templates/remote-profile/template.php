<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
    <? foreach ($arResult['ITEMS'] as $item) { ?>
        <tr>
            <td>
                <label class="checkbox-me">
                    <input type="checkbox" name="SALESOBJECTS[]" value="<?= $item->getID() ?>" class="js-checkbox" />
                    <span></span>
                </label>
            </td>
            <td>
                № <?= $item->getID() ?>
            </td>
            <td>
                <?= $item->getTitle() ?>
            </td>
            <td>
                <?= $item->getStatViews() ?>
            </td>
            <td>
                <?= $item->getStatSales() ?>
            </td>
        </tr>
    <? } ?>
    <tr class="separate">
        <td colspan="7">
            <?  // Постраничная навигация
                $APPLICATION->IncludeComponent(
                    "glyf:pagenavigation",
                    "gray",
                    array(
                        'JSID'    => 'js-sales-objects-nav-id',
                        'TOTAL'   => $arResult['TOTAL'],
                        'PERPAGE' => $arParams['PERPAGE'],
                        'CURRENT' => $arParams['PAGE'],
                    )
                );
            ?>
        </td>
    </tr>
<? } ?>