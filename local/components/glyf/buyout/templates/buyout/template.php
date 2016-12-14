<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="container">
    <div class="row">
        <? if (!$arResult['USER']->isPartner()) { ?>

            <div id="js-picture-delays-wrapper-id">
                <?	// Корзина (подготовка для покупки).
                    $APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket",
                        "delays",
                        array(),
                        $component
                    );
                ?>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                <div class="row">
                    <div id="js-picture-buyout-wrapper-id">
                        <?	// Покупка картины.
                            $APPLICATION->IncludeComponent(
                                "glyf:picture.buyout",
                                "buyout",
                                array(),
                                $component
                            );
                        ?>
                    </div>
                    
                    <div id="js-picture-basket-wrapper-id" class="col-sm-12 col-lg-4 pb30">
                        <?	// Корзина (покупка).
                            $APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket",
                                "basket",
                                array(),
                                $component
                            );
                        ?>
                    </div>
                </div>
            </div>
            
        <? } else { ?>
        
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 col-xs-offset-12 col-sm-offset-4 col-md-offset-4 col-lg-offset-3">
                <div class="col-sm-12 col-lg-8 pb30">
                    <div class="buyout-no-select">
                        <p><?= getMessage('GL_ERROR_PARTNER_BASKET') ?></p>
                    </div>
                </div>
            </div>
            
        <? } ?>
    </div>
</div>