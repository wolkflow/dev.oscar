<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-user-lightbox-block-id">
    <? if (!empty($arResult['LIGHTBOX'])) { ?>
        <ol class="breadcrumb">
            <li><a href="/personal/">Профиль</a></li>
            <li><?= $arResult['LIGHTBOX']['UF_TITLE'] ?></li>
        </ol>

        <div class="cabinet-panel clearfix">
            <div class="cabinet-panel__switch">
                <span class="is-active">
                    <?= $arResult['LIGHTBOX']['UF_TITLE'] ?>
                </span>
            </div>
            <div class="cabinet-panel__toggler">Коллекции</div>
            <div class="cabinet-panel__menu">
                <a class="js-dependence-chekbox-button js-group-action" data-action="loadpdf" href="javascript:void(0)">сохранить пдф</a>
                <a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascript:void(0)">отправить по email</a>
                <a class="js-dependence-chekbox-button js-group-action" data-action="print" href="javascript:void(0)">печать</a>
                <a class="js-dependence-chekbox-button" href="javascript:void(0)" id="js-add-list-to-cart-id">
                    Добавить в корзину
                </a>
                <a class="js-dependence-chekbox-button" href="javascript:void(0)" id="js-remove-list-from-lightbox-id" data-lid="<?= $arResult['LIGHTBOX']['ID'] ?>">
                    удалить
                </a>
            </div>
        </div>

        <form>
            <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
            <div class="lightboxes-set" id="js-lightbox-pictures-wrapper-id" data-lid="<?= $arResult['LIGHTBOX']['ID'] ?>">
                <? if (!empty($arResult['ITEMS'])) { ?>
                    <?  // Статистика по папке.					
                        $APPLICATION->IncludeComponent(
                            "glyf:user.lightbox",
                            "remote-profile",
                            array(
                                "LID"  => $arResult['LIGHTBOX']['ID'],
                                "PAGE" => 1,
                            )
                        );
                    ?>
                <? } else { ?>
                    <div class="lightbox-empty">
                        <?= getMessage('GL_LAIGHTBOX_PICTURES_NO_FOUND') ?>
                    </div>
                <? } ?>
            </div>
        </form>
    <? } else { ?>
        <p><?= getMessage('GL_LAIGHTBOX_NO_FOUND') ?></p>
    <? } ?>
</div>