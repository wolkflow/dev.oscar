<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Statistic\Sale; ?>
<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-block cabinet-block-profilehistory is-active">
    <div class="cabinet-panel clearfix">
        <div class="cabinet-panel__toggler">История заказов</div>
        <div class="cabinet-panel__title">История заказов</div>
        <div class="cabinet-panel__menu">
        
            <a class="is-active" href="javascript:void(0)" id="js-check-all-id" data-selector=".js-checkbox">выделить всё</a>
            <a class="hidden-sm" href="#">загрузить пдф</a>
            <a class="" href="#">отправить по email</a>
            <a class="hidden-sm" href="#">печать</a>
            <a href="#">повторить заказ</a>
            
            <div class="cabinet-panel__menu-pages hidden-xs">
                <span>показывать по</span>
                <select id="js-orders-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
                    <option value="30" <?= ($arParams['PERPAGE'] == 30) ? ('selected') : ('') ?> data-href="<?= $APPLICATION->GetCurPageParam('count=30', array('count', 'ELEMENT'), false) ?>">
                        30
                    </option>
                    <option value="60" <?= ($arParams['PERPAGE'] == 60) ? ('selected') : ('') ?> data-href="<?= $APPLICATION->GetCurPageParam('count=60', array('count', 'ELEMENT'), false) ?>">
                        60
                    </option>
                    <option value="90" <?= ($arParams['PERPAGE'] == 90) ? ('selected') : ('') ?> data-href="<?= $APPLICATION->GetCurPageParam('count=90', array('count', 'ELEMENT'), false) ?>">
                        90
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="cabinet-block-content">
        <table class="cabinet-table hidden-xs">
            <tbody id="js-orders-wrapper-id">
                <?  // Список заказов.
                    $APPLICATION->IncludeComponent(
                        "glyf:user.orders",
                        "remote-profile",
                        array("PERPAGE" => 1),
                        $component
                    );
                ?>
            </tbody>
        </table>
    </div>
</div>