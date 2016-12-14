<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

                
<div class="buyoutBlockTitle">
    <div class="buyoutBlockTitleText"><?= getMessage('GL_YOUR_ORDER') ?></div>
    <a id="js-basket-delete-id" href="javascript:void(0)" class="buyoutBlockTitleLink"><?= getMessage('GL_DELETE') ?></a>
    <a id="js-basket-buyout-id" href="javascript:void(0)" class="buyoutBlockTitleLink active"><?= getMessage('GL_BUY') ?></a>
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
                    <label class="checkbox-me">
                        <span class="buyoutSelected-img">
                            <span class="basket-chk">
                                <input type="checkbox" class="js-basket-picture" value="<?= $item['ID'] ?>" />
                                <span></span>
                            </span>
                            <img src="<?= $picture->getSmallPreviewImageSrc() ?>" title="<?= $picture->getTitle() ?>" />
                        </span>
                        <span class="buyoutSelected-meta">
                            <span class="buyoutSelected-title"><?= getMessage('GL_LICENSE') ?></span>
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
            <?= getMessage('GL_TOTAL') ?>: <?= number_format($price, 0, ',', ' ') ?> р.
        </div>
        <a id="js-basket-buyout-full-id" class="btn btn-default btn-sm buyoutSubmit" href="javascript:void(0)">
            <?= getMessage('GL_BUY') ?>
        </a>
    </div>
<? } else { ?>
    <div class="basket-note"><?= getMessage('GL_NO_OBJECTS') ?></div>
<? } ?>
