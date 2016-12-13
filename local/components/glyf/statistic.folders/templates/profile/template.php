<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>
<? use Glyf\Oscar\Folder; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-folders-block-id" class="cabinet-block cabinet-block-collections is-active">
    <div class="clearfix">
        <div class="cabinet-search">
            <span class="cabinet-search__title"><?= getMessage('GL_SEARCH_FOLDERS') ?></span>
            <div class="cabinet-search__form">
                <input type="text" id="js-folders-search-id" value="" />
            </div>
        </div>
    </div>
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__switch">
            <span class="is-active" data-block="collections"><?= getMessage('GL_FOLDERS') ?></span>
            <span data-block="objects"><?= getMessage('GL_OBJECTS') ?></span>
        </div>
        <div class="cabinet-panel__toggler"><?= getMessage('GL_FOLDERS') ?></div>
        <ul class="cabinet-panel__menu">
            <li>
                <div>
                    <span class="le-new-folder le disabled" data-le="addfolder">
                        <input type="text" name="title" id="js-folder-title-id" data-le="addfolder" class="le disabled" />
                        <a href="javascript:void(0)" class="le le-end is-active" data-le="addfolder" data-action="add-folder" data-callback="cAddFolder">OK</a>
                        <? /* <a href="javascript:void(0)" class="le le-end le-cancel" data-le="addfolder"></a> */ ?>
                    </span>
                    <a class="is-active le le-start" data-le="addfolder" href="javascipt:void(0)"><?= getMessage('GL_ADD_COLLECTION') ?></a>
                </div>
            </li>
            <li>
                <a class="is-active js-check-all" href="javascript:void(0)" data-selector=".js-checkbox"><?= getMessage('GL_SELECT_ALL') ?></a>
            </li>
            <li>
                <a class="hidden-sm js-dependence-chekbox-button js-group-action" data-action="loadpdf" href="javascipt:void(0)"><?= getMessage('GL_SAVE_PDF') ?></a>
            </li>
            <li>
                <a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascipt:void(0)"><?= getMessage('GL_SEND_VIA_EMAIL') ?></a>
            </li>
            <li>
                <a class="hidden-sm js-dependence-chekbox-button js-group-action" data-action="print" href="javascipt:void(0)"><?= getMessage('GL_PRINT') ?></a>
            </li>
            <li>
                <a id="js-remove-folders-id" class="js-dependence-chekbox-button" href="javascipt:void(0)"><?= getMessage('GL_DELETE') ?></a>
            </li>
            <li>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span><?= getMessage('GL_SHOW') ?></span>
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
            </li>
        </ul>
    </div>
    <form>
        <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
        <div id="js-folders-wrapper-id" class="cabinet-block-content">
            <?  // Статистика по папке.					
                $APPLICATION->IncludeComponent(
                    "glyf:statistic.folders",
                    "remote-profile",
                    array()
                );
            ?>
        </div>
    </form>
</div>