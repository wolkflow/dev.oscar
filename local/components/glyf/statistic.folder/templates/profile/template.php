<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['FOLDER'])) { ?>
    <div class="cabinet-content col-md-10 col-md-offset-1 col-sm-12">
        
        <ol class="breadcrumb">
            <li><a href="/personal/">Личный кабинет</a></li>
            <li><a href="#">Каталог</a></li>
            <li><a href="#">Все коллекции</a></li>
            <li>
                <?= $arResult['FOLDER']['UF_TITLE'] ?>
            </li>
        </ol>
        
        <div class="cabinet-panel clearfix">
            <div class="cabinet-panel__title">
                <?= $arResult['FOLDER']['UF_TITLE'] ?>
            </div>
            <div class="cabinet-panel__menu">
                <a class="is-active" href="#">выделить всё</a>
                <a class="hidden-sm" href="#">сохранить пдф</a>
                <a class="is-active" href="#">отправить по email</a>
                <a class="hidden-sm is-active" href="#">печать</a>
                <div class="cabinet-panel__menu-pages hidden-xs">
                    <span>показывать по</span>
                    <select name="" id="" class="styler shortSelect cabinet-panel__menu-pages-select">
                        <option value="30">30</option>
                        <option value="60">60</option>
                        <option value="90">90</option>
                    </select>
                </div>
            </div>
        </div>
        
        <table class="cabinet-table hidden-xs">
            <thead>
                <th></th>
                <th class="has-sort">ID<span class="cabinet-table__sort"></span></th>
                <th class="has-sort">Название<span class="cabinet-table__sort"></th>
                <th class="has-sort">Дата<span class="cabinet-table__sort"></th>
                <th class="has-sort">Просмотров<span class="cabinet-table__sort"></th>
                <th class="has-sort">Продаж<span class="cabinet-table__sort"></th>
            </thead>
            <tbody>
                <? foreach ($arResult['ITEMS'] as $item) { ?>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="FOLDER[]" value="<?= $item['ID'] ?>" />
                            </label>
                        </td>
                        <td>
                            № <?= $item[Picture::FIELD_ID] ?>
                        </td>
                        <td>
                            <?= $item[Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                        </td>
                        <td>
                            <? if ($item[Picture::FIELD_MODERATE]) { ?>
                                <?= date('d.m.Y', strtotime($item[Picture::FIELD_MODERATE_TIME])) ?>
                            <? } else { ?>
                                <span class="cabinet-table__bluetext">Модерация</span>
                            <? } ?>
                        </td>
                        <td>
                            <?= number_format($item['VIEWS'], 0, '.' , ' ') ?>
                        </td>
                        <td>
                            <?= number_format($item['SALES'], 0, '.' , ' ') ?>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
        
        <?  // Постраничная навигация
            $APPLICATION->IncludeComponent(
                "glyf:pagenavigation",
                "gray",
                array(
                    'JSID'    => 'js-folder-pictures-nav-id',
                    'TOTAL'   => $arResult['TOTAL'],
                    'PERPAGE' => $arParams['PERPAGE'],
                    'CURRENT' => $arParams['PAGE'],
                )
            );
        ?>
        
        <div class="cabinet-table-mobile visible-xs">
            <div class="cabinet-table-mobile__item row">
                <div class="col-xs-1">
                    <label><input type="checkbox"></label>
                </div>
                <div class="cabinet-table-mobile__data col-xs-11">
                    <div class="cabinet-table-mobile__data-row">
                        <span>№</span>
                        <span>1234567</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Название:</span>
                        <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Дата:</span>
                        <span>Модерация</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Просмотры:</span>
                        <span>6 543</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Продажи:</span>
                        <span>61 543</span>
                    </div>
                </div>
            </div>
            <div class="cabinet-table-mobile__item row">
                <div class="col-xs-1">
                    <label><input type="checkbox"></label>
                </div>
                <div class="cabinet-table-mobile__data col-xs-11">
                    <div class="cabinet-table-mobile__data-row">
                        <span>№</span>
                        <span>1234567</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Название:</span>
                        <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Дата:</span>
                        <span>Модерация</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Просмотры:</span>
                        <span>6 543</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Продажи:</span>
                        <span>61 543</span>
                    </div>
                </div>
            </div>
            <div class="cabinet-table-mobile__item row">
                <div class="col-xs-1">
                    <label><input type="checkbox"></label>
                </div>
                <div class="cabinet-table-mobile__data col-xs-11">
                    <div class="cabinet-table-mobile__data-row">
                        <span>№</span>
                        <span>1234567</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Название:</span>
                        <span>Поль Гоген, "Женщина, держащая плод" 1893г.</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Дата:</span>
                        <span>Модерация</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Просмотры:</span>
                        <span>6 543</span>
                    </div>
                    <div class="cabinet-table-mobile__data-row">
                        <span>Продажи:</span>
                        <span>61 543</span>
                    </div>
                </div>
            </div>
            <div class="cabinet-table-mobile__load">
                <a href="#" class="btn btn-light btn-more_params">Еще</a>
            </div>
        </div>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>