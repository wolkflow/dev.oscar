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
                <div class="col-sm-12 col-lg-8 pb30">
                    <div class="buyoutBlockTitle">
                        <div class="buyoutBlockTitleText">выбрать лицензию</div>
                        <a href="#" class="buyoutBlockTitleLink">удалить</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="buyoutBlockImage">
                                <img src="media/buyoutBlockImage.png" alt="">
                            </div>
                            <div class="buyoutBlockName">Богатыри</div>
                            <div class="buyoutBlockMeta">
                                <ul>
                                    <li><b>Автор:</b> Васнецов  В. М.</li>
                                    <li><b>Место создания:</b> Россия, Москва</li>
                                    <li><b>Время создания:</b> 1881—1898</li>
                                    <li><b>Техника:</b> Холст, масло</li>
                                    <li><b>Размеры:</b> 295,3 × 446 см</li>
                                    <li><b>Правообладатель:</b> Государственная Третьяковская галерея, Москва</li>
                                    <li><b>Категория:</b> Живопись</li>
                                    <li><b>ID:</b> 56490</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <form class="buyoutParams">
                                <ul class="buyoutParamsRadio">
                                    <li><label><input type="radio" name="buyoutParams"> Book Publishing</label></li>
                                    <li><label><input type="radio" name="buyoutParams"> Non-Commercial Display</label></li>
                                    <li><label><input type="radio" name="buyoutParams"> Web and App</label></li>
                                    <li><label><input type="radio" name="buyoutParams"> Periodical Publishing</label></li>
                                    <li><label><input type="radio" name="buyoutParams"> Presentation</label></li>
                                    <li><label><input type="radio" name="buyoutParams"> Other</label></li>
                                </ul>
                                
                                <ul class="buyoutParamsSelect">
                                    <li>
                                        <label for="buyoutType">Retail Book</label>
                                        <select name="" id="buyoutType" class="styler">
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label for="buyoutFormat">Формат</label>
                                        <select name="" id="buyoutFormat" class="styler">
                                            <option value="">Print</option>
                                            <option value="">Print</option>
                                            <option value="">Print</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label for="buyoutRegion">Регион</label>
                                        <select name="" id="buyoutRegion" class="styler">
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label for="buyoutSize">Размер</label>
                                        <select name="" id="buyoutSize" class="styler">
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                            <option value="">Retail Book</option>
                                        </select>
                                    </li>
                                </ul>
                                <div class="buyoutPrice">2 456 р.</div>
                                <input type="submit" class="btn btn-sm btn-default" value="Подтвердить">
                            </form>
                        </div>
                    </div>
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