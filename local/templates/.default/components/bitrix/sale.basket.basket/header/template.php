<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<ul class="nav navbar-cart hidden-xs">
    <li>
        <? if (CUser::IsAuthorized()) { ?>
            <a href="/buyout/">
                <span id="js-cart-count-id" class="cart-count">
                    <?= count($arResult['ITEMS']['DelDelCanBuy']) ?>
                </span>
                <i class="icon icon-cart"></i>
            </a>
        <? } else { ?>
            <a href="javascript:void(0)">
                <span id="js-cart-count-id" class="cart-count">
                    0
                </span>
                <i class="icon icon-cart"></i>
            </a>
        <? } ?>
    </li>
</ul>