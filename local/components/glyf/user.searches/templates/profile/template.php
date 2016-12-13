<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="filterSave">
    <a href="javascript:void(0)" class="btn btn-filter_save" data-collapse-target="searchSave"><?= getMessage('GL_SAVE_SEARCH') ?></a>
    <div class="filterSaveInner hide" data-collapse-block="searchSave">
        
        <input id="js-search-title-id" type="text" placeholder="Введите название" />
        <a href="javascript:void(0)" id="js-search-save-id" class="btn btn-light btn-filter_edit"><?= getMessage('GL_SAVE') ?></a>
        <hr/>
        
        <ul id="js-searches-id">
            <? foreach ($arResult['ITEMS'] as $id => $item) { ?>
                <? $link = '/search/?' . http_build_query($item['FILTER']) ?>
                <li>
                    <a href="<?= $link ?>"><?= $item['TITLE'] ?></a>
                </li>
            <? } ?>
        </ul>
        <a href="javascript:void(0)" id="js-search-edit-id" class="btn btn-light btn-filter_edit"><?= getMessage('GL_EDIT') ?></a>
        <a href="javascript:void(0)" id="js-search-remove-id" class="btn btn-light btn-filter_delete"><?= getMessage('GL_REMOVE_ALL') ?></a>
    </div>
</div>
