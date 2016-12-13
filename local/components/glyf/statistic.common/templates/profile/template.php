<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-block cabinet-block-stats is-active">
    <div class="cabinet-panel cabinet-panel--stats clearfix">
        <div class="cabinet-panel__toggler"><?= getMessage('GL_STATISTICS') ?></div>
        <div class="cabinet-panel__title"><?= getMessage('GL_STATISTICS') ?></div>
        <div class="cabinet-panel--stats-inner">
            <div class="cabinet-panel__stats">
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key"><?= getMessage('GL_ALL_OBJECTS') ?></span>
                    <span class="cabinet-panel__stat-item-key-short"><?= getMessage('GL_ALL_OBJECTS') ?></span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['COUNT'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key"><?= getMessage('GL_VIEWS_QUARTER') ?></span>
                    <span class="cabinet-panel__stat-item-key-short"><?= getMessage('GL_VIEWS_2') ?><sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['VIEWS'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key"><?= getMessage('GL_SALES_UARTER') ?></span>
                    <span class="cabinet-panel__stat-item-key-short"><?= getMessage('GL_SALES_2') ?><sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value">
                        <?= number_format($arResult['SALES'], '0', '', ' ') ?>
                    </span>
                </div>
                <div class="cabinet-panel__stat-item">
                    <span class="cabinet-panel__stat-item-key"><?= getMessage('GL_ACCORDING_RESULTS_PERIOD') ?></span>
                    <span class="cabinet-panel__stat-item-key-short"><?= getMessage('GL_PAYMENT_WILL_BE') ?><sup>*</sup></span>
                    <span class="cabinet-panel__stat-item-value cabinet-panel__stat-blue">
                        <?= number_format($arResult['PAYMENTS'], '0', '', ' ') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="cabinet-stats-info">
        <sup>*</sup>&nbsp;<?= getMessage('GL_AMOUNT_INDICATED_QUARTER') ?>
    </div>
</div>