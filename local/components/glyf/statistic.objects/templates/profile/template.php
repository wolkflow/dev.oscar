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
        <ul class="cabinet-panel__menu">
            <li><a class="is-active" href="/personal/upload/">добавить объект</a></li>
            <li><a class="is-active" href="#">выделить всё</a></li>
            <li><a class="hidden-sm" href="#">сохранить пдф</a></li>
            <li><a class="is-active" href="#">отправить по email</a></li>
            <li><a class="is-active hidden-sm" href="#">печать</a></li>
            <li>
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
            </li>
        </ul>
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
    </div>
</div>