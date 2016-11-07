<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['FOLDER'])) { ?>
    <? foreach ($arResult['ITEMS'] as $item) { ?>
        <tr>
            <td>
                <label>
                    <input type="checkbox" name="FOLDER[]" value="<?= $item['ID'] ?>" />
                </label>
            </td>
            <td>
                № <?= $item[Picture::FIELD_ID] ?>
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
                <?= number_format($item['VIEWS'], 0, '.' , ' ') ?>
            </td>
            <td>
                <?= number_format($item['SALES'], 0, '.' , ' ') ?>
            </td>
        </tr>
    <? } ?>
<? } ?>