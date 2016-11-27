<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


                
<div class="buyoutBlockTitle">
    <div class="buyoutBlockTitleText">ваш заказ</div>
    <a id="js-basket-delete-button-id" href="javascript:void(0)" class="buyoutBlockTitleLink">удалить</a>
    <a id="js-basket-buyout-button-id" href="javascript:void(0)" class="buyoutBlockTitleLink active">купить</a>
</div>

<div class="buyoutSelected">
    <? if (!empty($arResult['ITEMS']['AnDelCanBuy'])) { ?>
        <ul>
            <? foreach ($arResult['ITEMS']['AnDelCanBuy'] as $item) { ?>
                <? $picture = new Picture($item['PRODUCT_ID']); ?>
                <? $license = new License(); ?>
                
                <li>
                    <label>
                        <span class="buyoutSelected-img">
                            <input type="checkbox" class="js-basket" value="<?= $item['ID'] ?>" />
                            <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" />
                        </span>
                        <span class="buyoutSelected-meta">
                            <span class="buyoutSelected-title">Лицензия</span>
                            <span class="buyoutSelected-copy">
                                <?= $license->getTitle() ?>
                            </span>
                            <span class="buyoutSelected-price">
                                <?= number_format($item['PRICE'], 0, ',', ' ') ?> р.
                            </span>
                        </span>
                    </label>
                </li>
            <? } ?>
        </ul>
    <? } ?>
</div>

<? if (!empty($arResult['ITEMS']['AnDelCanBuy'])) { ?>
    <div class="buyoutTotal">
        <div class="buyoutTotalSum">
            Итого: 3 456 р.
        </div>
        <a class="btn btn-default btn-sm buyoutSubmit" href="javascript:void(0)">
            купить
        </a>
    </div>
<? } ?>
