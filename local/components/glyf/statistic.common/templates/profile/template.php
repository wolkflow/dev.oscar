<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-block cabinet-block-stats is-active">
    <div class="cabinet-panel cabinet-panel--stats clearfix">
        <div class="cabinet-panel__toggler">Статистика</div>
        <div class="cabinet-panel__title">Статистика</div>
        <div class="cabinet-panel--stats-inner">
            <div class="cabinet-panel__stats">
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key">всего объектов</span>
                    <span class="cabinet-panel__stat-item-key-short">всего объектов</span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['COUNT'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key">просмотры за квартал</span>
                    <span class="cabinet-panel__stat-item-key-short">просмотры<sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['VIEWS'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key">продажи за квартал</span>
                    <span class="cabinet-panel__stat-item-key-short">продажи<sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['SALES'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key">по итогам расчётного периода выплата составит</span>
                    <span class="cabinet-panel__stat-item-key-short">выплата составит<sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value cabinet-panel__stat-blue">
                        <?= number_format($arResult['PAYMENTS'], '0', '', ' ') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="cabinet-stats-info">
        <sup>*</sup>&nbsp;количество указано за квартал или расчётный период
    </div>
</div>