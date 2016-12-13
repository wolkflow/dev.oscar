<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-sales-objects-block-id" class="cabinet-block cabinet-block-statistics">
    <form>
        <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
        <div class="clearfix">
            <div class="cabinet-search">
                <span class="cabinet-search__title">поиск по продажам</span>
                <div class="cabinet-search__form">
                    <input id="js-sales-objects-search-id" type="text" name="title" value="" />
                </div>
            </div>
            <div class="cabinet-search">
                <span class="cabinet-search__title">выбрать период</span>
                <div class="cabinet-search__form">
                    <input id="js-sales-objects-period-min-search-id" type="text" name="PERIOD_MIN" value="<?= date('d.m.Y', strtotime('-1 month')) ?>" />
                    <input id="js-sales-objects-period-max-search-id" type="text" name="PERIOD_MAX" value="<?= date('d.m.Y') ?>" />
                </div>
            </div>
        </div>
        <div class="cabinet-panel cabinet-panel--switch clearfix">
            <div class="cabinet-panel__switch">
                <span data-block="history">История продаж</span>
                <span class="is-active" data-block="statistics">Статистика просмотров / продаж</span>
            </div>
            <div class="cabinet-panel__toggler">История продаж</div>
            <div class="cabinet-panel__menu">
                <a class="is-active js-check-all" href="javascript:void(0)">выделить всё</a>
                <a class="js-dependence-chekbox-button js-group-action hidden-sm"  data-action="loadpdf" href="javascript:void(0)">pdf</a>
                <a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascript:void(0)">отправить по email</a>
                <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="print" href="javascript:void(0)">печать</a>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span>показать по</span>
                    <select id="js-sales-objects-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
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
                        <th class="has-sort js-sort" data-sort="views">Просмотров<span class="cabinet-table__sort"></th>
                        <th class="has-sort js-sort" data-sort="sales">Продаж<span class="cabinet-table__sort"></th>
                    </tr>
                </thead>
                <tbody id="js-sales-objects-wrapper-id">
                    <?  // Статистика по объектам.					
                        $APPLICATION->IncludeComponent(
                            "glyf:statistic.sales.objects",
                            "remote-profile",
                            array(
                                "PERIOD_MIN" => date('d.m.Y', strtotime('-1 month')),
                                "PERIOD_MAX" => date('d.m.Y')
                            )
                        );
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>