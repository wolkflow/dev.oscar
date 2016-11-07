<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="filterSave">
    <a href="javascript:void(0)" class="btn btn-filter_save" data-collapse-target="searchSave">сохранить поиск</a>
    <div class="filterSaveInner hide" data-collapse-block="searchSave">
        
        <input id="js-search-title-id" type="text" placeholder="Введите название" />
        <a href="javascript:void(0)" id="js-search-save-id" class="btn btn-light btn-filter_edit">Сохранить</a>
        <hr/>
        
        <ul id="js-searches-id">
            <? foreach ($arResult['ITEMS'] as $id => $title) { ?>
                <li>
                    <a href="javascript:void(0)"><?= $title ?></a>
                </li>
            <? } ?>
        </ul>
        <a href="javascript:void(0)" class="btn btn-light btn-filter_edit">Редактировать</a>
        <a href="javascript:void(0)" class="btn btn-light btn-filter_delete">Удалить все</a>
    </div>
</div>
