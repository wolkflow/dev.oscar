<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div id="js-lightboxes-block-id" class="cabinet-block cabinet-block-lightboxes is-active clearfix">
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__toggler">Сборники</div>
        <div class="cabinet-panel__title">Сборники</div>
        <div class="cabinet-panel__menu">
            <a class="js-dependence-chekbox-button js-group-action" data-action="loadpdf" href="javascript:void(0)">сохранить пдф</a>
            <a class="js-dependence-chekbox-button js-group-action" data-action="mail" href="javascript:void(0)">отправить по email</a>
            <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="print" href="javascript:void(0)">печать</a>
            <a id="js-personal-lightbox-basket-id" class="js-dependence-chekbox-button" href="javascript:void(0)">добавить в корзину</a>
            <a class="js-dependence-chekbox-button le-lightbox-trigger" href="javascript:void(0)">переименовать</a>
            <a id="js-personal-lightbox-delete-id" class="js-dependence-chekbox-button" href="javascript:void(0)">
                удалить
            </a>
        </div>
    </div>
    <div id="js-porfile-lightboxes-wrapper-id">
        <form>
            <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
            <?  //Сборники.					
                $APPLICATION->IncludeComponent(
                    "glyf:lightbox.list",
                    "profile-remote",
                    array()
                );
            ?>
        </form>
    </div>
</div>
