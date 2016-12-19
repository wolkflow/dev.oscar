<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div id="js-objects-block-id" class="cabinet-block cabinet-block-objects">
    <div class="clearfix">
        <div class="cabinet-search">
            <span class="cabinet-search__title"><?= getMessage('GL_SEARCH_OBJECTS') ?></span>
            <div class="cabinet-search__form">
                <input type="text" id="js-objects-search-id" value="" />
            </div>
        </div>
    </div>
    <div class="cabinet-panel cabinet-panel--switch clearfix">
        <div class="cabinet-panel__switch">
            <span data-block="collections"><?= getMessage('GL_FOLDERS') ?></span>
            <span class="is-active" data-block="objects"><?= getMessage('GL_OBJECTS') ?></span>
        </div>
        <div class="cabinet-panel__toggler"><?= getMessage('GL_OBJECTS') ?></div>
        <ul class="cabinet-panel__menu">
            <li><a class="is-active" href="/personal/upload/"><?= getMessage('GL_ADD_OBJECT') ?></a></li>
            <li><a class="is-active js-check-all" href="javascript:void(0)"><?= getMessage('GL_SELECT_ALL') ?></a></li>
            <li><a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="loadpdf" href="javascript:void(0)"><?= getMessage('GL_SAVE_PDF') ?></a></li>
            <li><a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascript:void(0)"><?= getMessage('GL_SEND_VIA_EMAIL') ?></a></li>
            <li><a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="print" href="javascript:void(0)"><?= getMessage('GL_PRINT') ?></a></li>
            <li>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span><?= getMessage('GL_SHOW') ?></span>
                    <select id="js-objects-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
                        <option value="30" <?= ($arParams['PERPAGE'] == 30) ? ('selected') : ('') ?>>
                            30
                        </option>
                        <option value="60" <?= ($arParams['PERPAGE'] == 60) ? ('selected') : ('') ?>>
                            60
                        </option>
                        <option value="90" <?= ($arParams['PERPAGE'] == 90) ? ('selected') : ('') ?>>
                            90
                        </option>
                    </select>
                </div>
            </li>
        </ul>
    </div>
    <div class="cabinet-block-content">
        <form>
            <input type="hidden" name="UID" value="<?= CUser::GetID() ?>" />
            <table class="cabinet-table hidden-xs">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="has-sort js-sort" data-sort="ID">ID<span class="cabinet-table__sort"></span></th>
                    <th class="has-sort js-sort" data-sort="title"><?= getMessage('GL_SORT_TITLE') ?><span class="cabinet-table__sort"></th>
                    <th class="has-sort js-sort" data-sort="date"><?= getMessage('GL_SORT_DATE') ?><span class="cabinet-table__sort"></th>
                    <th class="has-sort js-sort" data-sort="views"><?= getMessage('GL_SORT_VIEWS') ?><span class="cabinet-table__sort"></th>
                    <th class="has-sort js-sort" data-sort="sales"><?= getMessage('GL_SORT_SALES') ?><span class="cabinet-table__sort"></th>
                </tr>
                </thead>
                <tbody id="js-objects-wrapper-id">
                    <?  // Статистика по объектам.
                        $APPLICATION->IncludeComponent(
                            "glyf:statistic.objects",
                            "remote-profile",
                            array()
                        );
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>