<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-block cabinet-block-objects">
    <div class="clearfix">
        <div class="cabinet-search">
            <span class="cabinet-search__title">поиск по объектам</span>
            <div class="cabinet-search__form">
                <input type="text" id="js-objects-search-id" value="" />
            </div>
        </div>
    </div>
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__switch">
            <span data-block="collections">Папки</span>
            <span class="is-active" data-block="objects">Объекты</span>
        </div>
        <div class="cabinet-panel__toggler">Объекты</div>
        <div class="cabinet-panel__menu">
            <a class="is-active" href="/personal/upload/">добавить объект</a>
            <a class="is-active" href="#">выделить всё</a>
            <a class="hidden-sm" href="#">сохранить пдф</a>
            <a class="is-active" href="#">отправить по email</a>
            <a class="is-active hidden-sm" href="#">печать</a>
            
            <div class="cabinet-panel__menu-pages hidden-xs">
                <span>показывать по</span>
                <select id="js-objects-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
                    <option value="30" <?= ($arParams['PERPAGE'] == 30) ? ('selected') : ('') ?>>
                        30
                    </option>
                    <option value="60" <?= ($arParams['PERPAGE'] == 60) ? ('selected') : ('') ?>>
                        60
                    </option>
                    <option value="90" <?= ($arParams['PERPAGE'] == 90) ? ('selected') : ('') ?>>
                        90
                    </option>
                </select>
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
            <tbody id="js-objects-wrapper-id">
                <?  // Статистика по объектам.					
                    $APPLICATION->IncludeComponent(
                        "glyf:statistic.objects",
                        "remote-profile",
                        array()
                    );
                ?>
            </tbody>
        </table>
        <? /*
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
        */ ?>
    </div>
</div>