<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>
<div class="cabinet-content col-md-12 col-sm-12">
    
    <ol class="breadcrumb">
        <li><a href="/personal/">Личный кабинет</a></li>
        <li>Каталог</li>
    </ol>

    <div class="cabinet-block cabinet-block-collections is-active">
        <div class="clearfix">
            <div class="cabinet-search">
                <span class="cabinet-search__title">поиск по коллекциям</span>
                <div class="cabinet-search__form">
                    <input type="text" />
                </div>
            </div>
        </div>
        <div class="cabinet-panel cabinet-panel--switch clearfix">
            <div class="cabinet-panel__switch">
                <span class="is-active" data-block="collections">Коллекции</span>
                <span data-block="objects">Объекты</span>
            </div>
            <div class="cabinet-panel__toggler">Коллекции</div>
            <div class="cabinet-panel__menu">
                <a class="is-active" href="#">добавить коллекцию</a>
                <a class="is-active" href="#">выделить всё</a>
                <a class="hidden-sm" href="#">сохранить пдф</a>
                <a class="is-active" href="#">отправить по email</a>
                <a class="is-active hidden-sm" href="#">печать</a>
                <a class="" href="#">удалить</a>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span>показывать по</span>
                        <select name="" id="" class="styler shortSelect cabinet-panel__menu-pages-select">
                                <option value="30">30</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                        </select>
                </div>
            </div>
        </div>
        <div class="cabinet-block-content">
            <div class="cabinet-collections">
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
                <div class="cabinet-collections__item">
                    <label><input type="checkbox"></label>
                    <img src="images/i_folder.png">
                    <span>Коллекция №1 - Иван Васильевич</span>
                </div>
            </div>
            <div class="cabinet-pagination hidden-xs">
                <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                <div class="cabinet-pagination__buttons">
                    <div class="cabinet-pagination__button cabinet-pagination__button--prev">&lsaquo;</div>
                    <div class="cabinet-pagination__button cabinet-pagination__button--next is-active">&rsaquo;</div>
                </div>
            </div>
            <div class="visible-xs">
                <div class="cabinet-table-mobile__load">
                    <a href="#" class="btn btn-light btn-more_params">Еще</a>
                </div>
            </div>
        </div>
    </div>
    <div class="cabinet-block cabinet-block-objects">
        <div class="clearfix">
            <div class="cabinet-search">
                <span class="cabinet-search__title">поиск по объектам</span>
                <div class="cabinet-search__form">
                    <input type="text" />
                </div>
            </div>
        </div>
        <div class="cabinet-panel cabinet-panel--switch clearfix">
            <div class="cabinet-panel__switch">
                <span data-block="collections">Коллекции</span>
                <span class="is-active" data-block="objects">Объекты</span>
            </div>
            <div class="cabinet-panel__toggler">Объекты</div>
            <div class="cabinet-panel__menu">
                <a class="is-active" href="#">добавить объект</a>
                <a class="is-active" href="#">выделить всё</a>
                <a class="hidden-sm" href="#">сохранить пдф</a>
                <a class="is-active" href="#">отправить по email</a>
                <a class="is-active hidden-sm" href="#">печать</a>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span>показывать по</span>
                    <div class="cabinet-panel__menu-pages-select">30</div>
                </div>
            </div>
        </div>
        <div class="cabinet-block-content">
            <table class="cabinet-table hidden-xs">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="has-sort">ID<span class="cabinet-table__sort"></span></th>
                    <th class="has-sort">Название<span class="cabinet-table__sort"></th>
                    <th class="has-sort">Дата<span class="cabinet-table__sort"></th>
                    <th class="has-sort">Просмотров<span class="cabinet-table__sort"></th>
                    <th class="has-sort">Продаж<span class="cabinet-table__sort"></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label><input type="checkbox"></label></td>
                        <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                        <td>№ 1234567</td>
                        <td>Поль Гоген, "Женщина, держащая плод" 1893г.<span class="cabinet-table__subtext">Коллекция №1 - 123 Третьяковка</span></td>
                        <td><span class="cabinet-table__bluetext">Модерация</span></td>
                        <td>6 543</td>
                        <td>61 543</td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox"></label></td>
                        <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                        <td>№ 1234567</td>
                        <td>Поль Гоген, "Женщина, держащая плод" 1893г.<span class="cabinet-table__subtext">Коллекция №1 - 123 Третьяковка</span></td>
                        <td>34 223</td>
                        <td>6 543</td>
                        <td>61 543</td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox"></label></td>
                        <td><img class="cabinet-table__img" src="images/horse.png" alt=""></td>
                        <td>№ 1234567</td>
                        <td>Виктор Васнецов "Богатыри", 1898г.<span class="cabinet-table__subtext">Коллекция №1 - 123 Третьяковка</span></td>
                        <td>1 234</td>
                        <td>1 234</td>
                        <td>1 234</td>
                    </tr>
                </tbody>
            </table>
            <div class="cabinet-pagination hidden-xs">
                <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                <div class="cabinet-pagination__buttons">
                    <div class="cabinet-pagination__button cabinet-pagination__button--prev">&lsaquo;</div>
                    <div class="cabinet-pagination__button cabinet-pagination__button--next is-active">&rsaquo;</div>
                </div>
            </div>
            <div class="cabinet-table-mobile visible-xs">
                <div class="cabinet-table-mobile__item row">
                    <div class="col-xs-1">
                        <label><input type="checkbox"></label>
                    </div>
                    <div class="cabinet-table-mobile__data col-xs-11">
                        <div class="cabinet-table-mobile__data-row">
                            <span>№</span>
                            <span>1234567</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Название:</span>
                            <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Дата:</span>
                            <span>Модерация</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Просмотры:</span>
                            <span>6 543</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Продажи:</span>
                            <span>61 543</span>
                        </div>
                    </div>
                </div>
                <div class="cabinet-table-mobile__item row">
                    <div class="col-xs-1">
                        <label><input type="checkbox"></label>
                    </div>
                    <div class="cabinet-table-mobile__data col-xs-11">
                        <div class="cabinet-table-mobile__data-row">
                            <span>№</span>
                            <span>1234567</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Название:</span>
                            <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Дата:</span>
                            <span>Модерация</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Просмотры:</span>
                            <span>6 543</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Продажи:</span>
                            <span>61 543</span>
                        </div>
                    </div>
                </div>
                <div class="cabinet-table-mobile__item row">
                    <div class="col-xs-1">
                        <label><input type="checkbox"></label>
                    </div>
                    <div class="cabinet-table-mobile__data col-xs-11">
                        <div class="cabinet-table-mobile__data-row">
                            <span>№</span>
                            <span>1234567</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Название:</span>
                            <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Дата:</span>
                            <span>Модерация</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Просмотры:</span>
                            <span>6 543</span>
                        </div>
                        <div class="cabinet-table-mobile__data-row">
                            <span>Продажи:</span>
                            <span>61 543</span>
                        </div>
                    </div>
                </div>
                <div class="cabinet-table-mobile__load">
                    <a href="#" class="btn btn-light btn-more_params">Еще</a>
                </div>
            </div>
        </div>
    </div>
</div>