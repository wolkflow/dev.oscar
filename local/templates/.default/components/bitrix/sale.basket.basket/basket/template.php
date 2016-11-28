<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


                
<div class="buyoutBlockTitle">
    <div class="buyoutBlockTitleText">ваш заказ</div>
    <a id="js-basket-delete-id" href="javascript:void(0)" class="buyoutBlockTitleLink">удалить</a>
    <a id="js-basket-buyout-id" href="javascript:void(0)" class="buyoutBlockTitleLink active">купить</a>
</div>

<div class="buyoutSelected">
    <? if (!empty($arResult['ITEMS']['AnDelCanBuy'])) { ?>
        <ul id="js-basket-pictures-wrapper-id">
            <? $price = 0; ?>
            <? foreach ($arResult['ITEMS']['AnDelCanBuy'] as $item) { ?>
                <? $price += (float) $item['PRICE'] ?>
                <? $picture = new Picture($item['PRODUCT_ID']); ?>
                <? $license = new License($item['TYPE']); ?>
                
                <li id="js-basket-<?= $item['ID'] ?>-id">
                    <label>
                        <span class="buyoutSelected-img">
                            <input type="checkbox" class="js-basket-picture" value="<?= $item['ID'] ?>" />
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
            Итого: <?= number_format($price, 0, ',', ' ') ?> р.
        </div>
        <a id="js-basket-buyout-full-id" class="btn btn-default btn-sm buyoutSubmit" href="javascript:void(0)">
            купить
        </a>
    </div>
<? } else { ?>
    <div class="basket-note">Ни одной позиции не добавлено</div>
<? } ?>
