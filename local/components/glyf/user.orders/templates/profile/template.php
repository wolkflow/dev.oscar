<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Statistic\Sale; ?>
<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\License; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-orders-block-id" class="cabinet-block cabinet-block-profilehistory is-active">
    <div class="cabinet-panel clearfix">
        <div class="cabinet-panel__toggler"><?= getMessage('GL_ORDERS_HISTORY') ?></div>
        <div class="cabinet-panel__title"><?= getMessage('GL_ORDERS_HISTORY') ?></div>
        <ul class="cabinet-panel__menu">
            <li><a class="is-active" href="javascript:void(0)" id="js-check-all-id" data-selector=".js-checkbox"><?= getMessage('GL_SELECT_ALL') ?></a></li>
            <li><a class="js-dependence-chekbox-button js-group-action hidden-sm" href="javascript:void(0)" data-action="loadpdf">PDF</a></li>
            <li><a class="js-dependence-chekbox-button js-group-action" href="javascript:void(0)" data-action="email"><?= getMessage('GL_SEND_VIA_EMAIL') ?></a></li>
            <li><a class="js-dependence-chekbox-button js-group-action hidden-sm" href="javascript:void(0)" data-action="print"><?= getMessage('GL_PRINT') ?></a></li>
            <li><a class="js-dependence-chekbox-button" id="js-orders-repeat-id" href="javascript:void(0)"><?= getMessage('GL_REPEAT_ORDER') ?></a></li>

            <li><div class="cabinet-panel__menu-pages hidden-xs">
                <span><?= getMessage('GL_SHOW') ?></span>
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
            </div></li>
        </ul>
    </div>
    <div class="cabinet-block-content">
        <form>
            <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
            <table class="cabinet-table">
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
        </form>
    </div>
</div>