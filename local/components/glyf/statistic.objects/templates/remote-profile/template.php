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
                    <input type="checkbox" name="IDS[]" value="<?= $item->getID() ?>" class="js-checkbox" />
                    <span></span>
                </label>
            </td>
            <td>
                <img class="small-image" src="<?= $item->getSmallPreviewImageSrc() ?>" />
            </td>
            <td>
                № <?= $item->getViewID() ?>
            </td>
            <td>
                <?= $item->getTitle() ?>
            </td>
            <td>
                <? if ($item->isModerate()) { ?>
                    <?= date('d.m.Y', $item->getModerateTime()->getTimeStamp()) ?>
                <? } else { ?>
                    <span class="cabinet-table__bluetext"><?= getMessage('GL_MODERATION') ?></span>
                <? } ?>
            </td>
            <td>
                <?= number_format($item->getStatViews(), 0, '.' , ' ') ?>
            </td>
            <td>
                <?= number_format($item->getStatSales(), 0, '.' , ' ') ?>
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
                        'JSID'    => 'js-objects-nav-id',
                        'TOTAL'   => $arResult['TOTAL'],
                        'PERPAGE' => $arParams['PERPAGE'],
                        'CURRENT' => $arParams['PAGE'],
                    )
                );
            ?>
        </td>
    </tr>
<? } ?>