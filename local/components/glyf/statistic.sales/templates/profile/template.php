<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-sales-block-id" class="cabinet-block cabinet-block-history is-active">
    <div class="clearfix">
        <div class="cabinet-search">
            <span class="cabinet-search__title">поиск по продажам</span>
            <div class="cabinet-search__form">
                <input id="js-sales-search-id" type="text" name="title" value="" />
            </div>
        </div>
        <div class="cabinet-search">
            <span class="cabinet-search__title">выбрать период</span>
            <div class="cabinet-search__form">
                <input id="js-sales-period-min-search-id" type="text" name="PERIOD_MIN" value="<?= date('d.m.Y', strtotime('-1 month')) ?>" />
                <input id="js-sales-period-max-search-id" type="text" name="PERIOD_MAX" value="<?= date('d.m.Y') ?>" />
            </div>
        </div>
    </div>
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__switch">
            <span class="is-active" data-block="history">История продаж</span>
            <span data-block="statistics">Статистика просмотров / продаж</span>
        </div>
        <div class="cabinet-panel__toggler">История продаж</div>
        <div class="cabinet-panel__menu">
            <a class="is-active js-check-all" href="javascript:void(0)">выделить всё</a>
            <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="loadpdf" href="javascript:void(0)">сохранить пдф</a>
            <a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascript:void(0)">отправить по email</a>
            <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="print" href="javascript:void(0)">печать</a>
            <div class="cabinet-panel__menu-pages hidden-xs">
                <span>показывать по</span>
                <select id="js-sales-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
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
                    <th class="has-sort js-sort js-sort-active" data-sort="ID">ID<span class="cabinet-table__sort"></span></th>
                    <th class="has-sort js-sort" data-sort="title">Название<span class="cabinet-table__sort"></th>
                    <th class="has-sort js-sort" data-sort="price">Цена (руб)<span class="cabinet-table__sort"></th>
                    <th class="has-sort js-sort" data-sort="date">Дата<span class="cabinet-table__sort"></th>
                </tr>
            </thead>
            <tbody id="js-sales-wrapper-id">
                <form>
                    <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
                    <?  // Статистика по объектам.					
                        $APPLICATION->IncludeComponent(
                            "glyf:statistic.sales",
                            "remote-profile",
                            array(
                                "PERIOD_MIN" => date('d.m.Y', strtotime('-1 month')),
                                "PERIOD_MAX" => date('d.m.Y')
                            )
                        );
                    ?>
                </form>
            </tbody>
        </table>
    </div>
</div>

<?
 // Запускаем скрипт тут, так как вероятно будет модификация начальной и конечной даты.
 // Вроде такой: начальная дата не может быть меньше даты регистрации
 // Конечная не может быть больше текущей

?>