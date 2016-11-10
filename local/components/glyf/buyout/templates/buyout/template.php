<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="container">
    <div class="row">
        <?	// Корзина.
            $APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket",
                "buyout",
                array(),
                $component
            );
        ?>
    
        
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
                
                
                <div class="col-sm-12 col-lg-4 pb30">
                    <div class="buyoutBlockTitle">
                        <div class="buyoutBlockTitleText">ваш заказ</div>
                        <a href="#" class="buyoutBlockTitleLink">удалить</a>
                        <a href="#" class="buyoutBlockTitleLink active">купить</a>
                    </div>
                    <div class="buyoutSelected">
                        <ul>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="buyoutSelected-img">
                                        <input type="checkbox">
                                        <img src="media/buyoutSelected.png" alt="">
                                    </span>
                                    <span class="buyoutSelected-meta">
                                        <span class="buyoutSelected-title">Лицензия</span>
                                        <span class="buyoutSelected-copy">Book Publishing</span>
                                        <span class="buyoutSelected-price">456 р.</span>
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="buyoutTotal">
                        <div class="buyoutTotalSum">
                            Итого: 3 456 р.
                        </div>
                        <a class="btn btn-default btn-sm buyoutSubmit" href="#">купить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>