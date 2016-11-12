<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\Folder; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-block cabinet-block-collections is-active">
    <div class="clearfix">
        <div class="cabinet-search">
            <span class="cabinet-search__title">поиск по папкам</span>
            <div class="cabinet-search__form">
                <input type="text" id="js-folders-search-id" value="" />
            </div>
        </div>
    </div>
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__switch">
            <span class="is-active" data-block="collections">Папки</span>
            <span data-block="objects">Объекты</span>
        </div>
        <div class="cabinet-panel__toggler">Папки</div>
        <div class="cabinet-panel__menu">
            <a class="is-active" href="#">добавить коллекцию</a>
            <a class="is-active" href="javascript:void(0)" id="js-check-all-id" data-selector=".js-checkbox">выделить всё</a>
            <a class="hidden-sm" href="#">сохранить пдф</a>
            <a class="is-active" href="#">отправить по email</a>
            <a class="is-active hidden-sm" href="#">печать</a>
            <a class="" href="#">удалить</a>
            
            <div class="cabinet-panel__menu-pages hidden-xs">
                <span>показывать по</span>
                <select id="js-folders-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
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
    <div id="js-folders-wrapper-id" class="cabinet-block-content">
        <?  // Статистика по папке.					
            $APPLICATION->IncludeComponent(
                "glyf:statistic.folders",
                "remote-profile",
                array()
            );
        ?>
        <? /*
        <div class="visible-xs">
            <div class="cabinet-table-mobile__load">
                <a href="#" class="btn btn-light btn-more_params">Еще</a>
            </div>
        </div>
        */ ?>
    </div>
</div>