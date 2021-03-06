<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['FOLDER'])) { ?>
    <div id="js-folder-block-id" class="cabinet-content col-md-10 col-md-offset-1 col-sm-12">
        
        <ol class="breadcrumb">
            <li><a href="/personal/"><?= getMessage('GL_PERSONAL_CABINET') ?></a></li>
            <li><a href="/personal/folders/"><?= getMessage('GL_PERSONAL_CATALOG') ?></a></li>
            <li>
                <?= $arResult['FOLDER']['UF_TITLE'] ?>
            </li>
        </ol>
        
        <div class="cabinet-panel clearfix">
            <div class="cabinet-panel__title">
                <?= $arResult['FOLDER']['UF_TITLE'] ?>
            </div>
            <div class="cabinet-panel__menu">
                <a class="is-active js-check-all" href="javascript:void(0)" data-selector=".js-checkbox">
                    <?= getMessage('GL_SELECT_ALL') ?>
                </a>
                <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="loadpdf" href="javascript:void(0)">
                    <?= getMessage('GL_SAVE_PDF') ?>
                </a>
                <a class="js-dependence-chekbox-button js-group-action" data-action="email" href="javascript:void(0)">
                    <?= getMessage('GL_SEND_VIA_EMAIL') ?>
                </a>
                <a class="js-dependence-chekbox-button js-group-action hidden-sm" data-action="print" href="javascript:void(0)">
                    <?= getMessage('GL_PRINT') ?>
                </a>
                
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span><?= getMessage('GL_SHOW') ?></span>
                    <select id="js-folder-pictures-page-count-id" class="styler shortSelect cabinet-panel__menu-pages-select">
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
        
        <form>
            <input type="hidden" name="UID" value="<?= CUser::getID() ?>" />
            <table class="cabinet-table hidden-xs">
                <thead id="js-folder-pictures-order-id">
                <tr>
                    <th></th>
                    <th class="has-sort sort-id js-order js-active-order" data-order="ID">
                        <?= getMessage('GL_SORT_ID') ?> <span class="cabinet-table__sort"></span>
                    </th>
                    <th class="has-sort sort-title js-order" data-order="title">
                        <?= getMessage('GL_SORT_TITLE') ?> <span class="cabinet-table__sort">
                    </th>
                    <th class="has-sort sort-date js-order" data-order="date">
                        <?= getMessage('GL_SORT_DATE') ?> <span class="cabinet-table__sort">
                    </th>
                    <th class="has-sort sort-views js-order" data-order="views">
                        <?= getMessage('GL_SORT_VIEWS') ?> <span class="cabinet-table__sort">
                    </th>
                    <th class="has-sort sort-sales js-order" data-order="sales">
                        <?= getMessage('GL_SORT_SALES') ?> <span class="cabinet-table__sort">
                    </th>
                </tr>
                </thead>
                <tbody id="js-folder-pictures-wrapper-id" data-fid="<?= $arResult['FOLDER']['ID'] ?>">
                    <?  // Статистика по папке.					
                        $APPLICATION->IncludeComponent(
                            "glyf:statistic.folder",
                            "remote-profile",
                            array(
                                "FID"  => $arResult['FOLDER']['ID'],
                                "PAGE" => 1,       
                            )
                        );
                    ?>
                </tbody>
            </table>
        </form>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>