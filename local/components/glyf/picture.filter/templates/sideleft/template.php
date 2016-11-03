<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-3 col-lg-2 sidebarLeft">
    
    <form action="/search/">
        <div class="sidebarLeftTitle formParamsTitle" data-collapse-target="formParams">
            <?= getMessage('GL_SEARCH_PARAMS') ?>
        </div>
    
        <div class="form" data-collapse-block="formParams">
            <ul class="filters filtersSet">
                <li>
                    <label class="filtersTitle" for="js-param-title-id">
                        <?= getMessage('GL_SEARCH_PARAM_TITLE') ?>
                    </label>
                    <input type="text" id="js-param-title-id" name="F[TITLE]" value="<?= $arResult['DATA']['TITLE'] ?>" />
                </li>
                <li>
                    <label class="filtersTitle" for="js-param-author-id">
                        <?= getMessage('GL_SEARCH_PARAM_AUTHOR') ?>
                    </label>
                    <input type="hidden" id="js-param-author-id" name="F[AUTHOR]" value="<?= $arResult['DATA']['AUTHOR'] ?>" />
                    <input type="text" class="suggest" data-type="author" data-input="#js-param-author-id" name="F[AUTHOR_TITLE]" value="<?= $arResult['DATA']['AUTHOR_TITLE'] ?>" />
                    <ul id="js-suggets-author-id" class="hide suggest"></ul>
                </li>
                <li>
                    <label class="filtersTitle" for="js-param-holder-id">
                        <?= getMessage('GL_SEARCH_PARAM_HOLDER') ?>
                    </label>
                    <input type="hidden" id="js-param-holder-id" name="F[HOLDER]" value="<?= $arResult['DATA']['HOLDER'] ?>" />
                    <input type="text" class="suggest" data-type="holder" data-input="#js-param-holder-id" name="F[HOLDER_TITLE]" value="<?= $arResult['DATA']['HOLDER_TITLE'] ?>" />
                    <ul id="js-suggets-holder-id" class="hide suggest"></ul>
                </li>
                <li class="ci-period-li">
                    <label class="filtersTitle display-inlineBlock" for="ci-period">
                        <?= getMessage('GL_SEARCH_PARAM_PERIOD') ?>
                    </label>
                    <label class="label-radio">
                        <input type="radio" name="F[ISYEAR]" id="ci-period" value="YEAR" class="styler" <?= ($arResult['DATA']['ISYEAR'] == 'YEAR' || empty($arResult['DATA']['ISYEAR'])) ? ('checked') : ('') ?> />
                        <?= getMessage('GL_SEARCH_PARAM_YEAR') ?>
                    </label>
                    <label class="label-radio">
                        <input type="radio" name="F[ISYEAR]" class="styler" value="CENTURY" <?= ($arResult['DATA']['ISYEAR'] == 'CENTURY') ? ('checked') : ('') ?> />
                        <?= getMessage('GL_SEARCH_PARAM_CENTURY') ?>
                    </label>
                    <div class="periodSelect">
                        <div class="periodSelect_first">
                            <input type="text" name="F[PERIOD_FROM]" value="<?= $arResult['DATA']['PERIOD_FROM'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_FROM') ?>" />
                            <select class="styler" name="F[PERIOD_FROM_ERA]">
                                <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_BC || empty($arResult['DATA']['PERIOD_FROM_ERA'])) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_BC') ?>
                                </option>
                                <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_AD') ?>
                                </option>
                            </select>
                        </div>
                        <div class="periodSelect_second">
                            <input type="text" name="F[PERIOD_TO]" value="<?= $arResult['DATA']['PERIOD_TO'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_TO') ?>" />
                            <select class="styler" name="F[PERIOD_TO_ERA]">
                                <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_BC || empty($arResult['DATA']['PERIOD_TO_ERA'])) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_BC') ?>
                                </option>
                                <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_AD') ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="filterBlock">
                    <label class="filtersTitle" for="ci-right_technique">
                        <?= getMessage('GL_SEARCH_PARAM_TECHNIQUE') ?>
                    </label>
                    <input type="hidden" id="js-param-technique-id" name="F[TECHNIQUE]" value="<?= $arResult['DATA']['TECHNIQUE'] ?>" />
                    <input type="text" class="suggest" data-type="technique" data-input="#js-param-technique-id" name="F[TECHNIQUE_TITLE]" value="<?= $arResult['DATA']['TECHNIQUE_TITLE'] ?>" />
                    <ul id="js-suggets-technique-id" class="hide suggest"></ul>
                </li>
                <li>
                    <label class="filtersTitle" for="ci-right_id">
                        <?= getMessage('GL_SEARCH_PARAM_ID') ?>
                    </label>
                    <input type="text" id="ci-right_id" name="F[ID]" value="<?= $arResult['DATA']['ID'] ?>" />
                </li>
                <li>
                    <label class="filtersTitle" for="ci-right_keywords">
                        <?= getMessage('GL_SEARCH_PARAM_KEYWORDS') ?>
                    </label>
                    <input type="text" id="ci-right_keywords" name="F[KEYWORDS]" value="<?= $arResult['DATA']['KEYWORDS'] ?>" />
                </li>
                <li>
                    <input type="submit" class="btn btn-find" value="<?= getMessage('GL_SEARCH_BUTTON_SUBMIT') ?>" />
                </li>
            </ul>
        </div>
    
        <div class="sidebarLeftTitle" data-collapse-target="formFilters">
            <?= getMessage('GL_SEARCH_FILTERS') ?>
        </div>
        
        <div class="form" data-collapse-block="formFilters">
            <div class="filterBlock shortParamsSet filterBlock-type">

                <div class="filterBlockTitle">
                    <?= getMessage('GL_SEARCH_PARAM_COLLECTION') ?>
                </div>

                <? if (count($arResult['FILTERS']['COLLECTION']) > 5) { ?>
                    <? $collections = array_slice($arResult['FILTERS']['COLLECTION'], 0, 5); ?>
                    <ul>
                        <? foreach ($collections as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[COLLECTION][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['COLLECTION'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                               </label>
                            </li>
                        <? } ?>
                    </ul>
                    
                    <? $collections = array_slice($arResult['FILTERS']['COLLECTION'], 5); ?>
                    <ul class="moreParamsList">
                        <? foreach ($collections as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[COLLECTION][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['COLLECTION'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                               </label>
                            </li>
                        <? } ?>
                    </ul>

                    <a href="#" class="btn btn-light btn-more_params">
                        <?= getMessage('GL_SEARCH_BUTTON_MORE') ?>
                    </a>
                <? } else { ?>
                    <ul>
                        <? foreach ($arResult['FILTERS']['COLLECTION'] as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[COLLECTION][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['COLLECTION'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                               </label>
                            </li>
                        <? } ?>
                    </ul>
                <? } ?>
            </div>
            <div class="filterBlock shortParamsSet filterBlock-genre">
                <div class="filterBlockTitle">
                    <?= getMessage('GL_SEARCH_PARAM_GENRE') ?>
                </div>
                <? if (count($arResult['FILTERS']['GENRE']) > 5) { ?>
                    <? $collections = array_slice($arResult['FILTERS']['GENRE'], 0, 5); ?>
                        <ul>
                            <? foreach ($collections as $value => $title) { ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="F[GENRE][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['GENRE'])) ? ('checked') : ('') ?> />
                                        <?= $title ?>
                                   </label>
                                </li>
                            <? } ?>
                        </ul>
                    <? $collections = array_slice($arResult['FILTERS']['GENRE'], 5); ?>
                    <ul class="moreParamsList">
                        <? foreach ($collections as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[COLLECTION][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['COLLECTION'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                                </label>
                            </li>
                        <? } ?>
                    </ul>

                    <a href="#" class="btn btn-light btn-more_params">
                        <?= getMessage('GL_SEARCH_BUTTON_MORE') ?>
                    </a>
                <? } else { ?>
                <ul>
                    <? foreach ($arResult['FILTERS']['GENRE'] as $value => $title) { ?>
                        <li>
                            <label>
                                <input type="checkbox" name="F[GENRE][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['GENRE'])) ? ('checked') : ('') ?> />
                                <?= $title ?>
                            </label>
                        </li>
                    <? } ?>
                </ul>
                <? } ?>
            </div>
            <ul class="filters">
                <li>
                    <label class="filtersTitle">
                        <?= getMessage('GL_SEARCH_PARAM_PLACE') ?>
                    </label>
                    <input type="hidden" id="js-param-country-id" name="F[COUNTRY]" value="<?= $arResult['DATA']['COUNTRY'] ?>" placeholder="Страна" />
                    <input type="text" id="js-param-place-country-id" name="F[COUNTRY_TITLE]" data-type="place-country" data-input="#js-param-country-id" value="<?= $arResult['DATA']['COUNTRY_TITLE'] ?>" />
                </li>
                <li>
                    <input type="hidden" id="js-param-city-id" name="F[CITY]" value="<?= $arResult['DATA']['CITY'] ?>" placeholder="Город" />
                    <input type="text" id="js-param-place-city-id" name="F[CITY_TITLE]" data-type="place-city" data-input="#js-param-city-id" value="<?= $arResult['DATA']['CITY_TITLE'] ?>" />
                </li>
                
                <li class="filterBlock filterBlock-size">
                    <label class="filtersTitle">
                        <?= getMessage('GL_SEARCH_PARAM_SIZE') ?>
                    </label>
                    <input type="text" class="input-size pull-left" name="F[SIZEMIN]" value="<?= $arResult['DATA']['SIZEMIN'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_FROM') ?>" />
                    <input type="text" class="input-size pull-right" name="F[SIZEMAX]" value="<?= $arResult['DATA']['SIZEMAX'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_TO') ?>" />
                    <span class="ci-divider"></span>
                </li>
                <li class="filterBlock filterBlock-color">
                    <label class="filtersTitle" for="ci-colors_colored">
                        <?= getMessage('GL_SEARCH_PARAM_COLOR') ?>
                    </label>
                    <ul>
                        <? foreach ($arResult['FILTERS']['COLOR'] as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[COLOR][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['COLOR'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                               </label>
                            </li>
                        <? } ?>
                    </ul>
                </li>
                <li class="filterBlock filterBlock-right">
                    <label class="filtersTitle" for="ci-right-pack">
                        <?= getMessage('GL_SEARCH_PARAM_LEGAL') ?>
                    </label>
                    <ul>
                        <? foreach ($arResult['FILTERS']['LEGAL'] as $value => $title) { ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="F[LEGAL][]" value="<?= $value ?>" <?= (in_array($value, $arResult['DATA']['LEGAL'])) ? ('checked') : ('') ?> />
                                    <?= $title ?>
                               </label>
                            </li>
                        <? } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </form>
    
    <? // Сохраненнный поиск. // ?>
    <div class="filterSave">
        <a href="#" class="btn btn-filter_save" data-collapse-target="searchSave">сохранить поиск</a>
        <div class="filterSaveInner hide" data-collapse-block="searchSave">
            <form action="">
                <input type="text" placeholder="Введите название">
                <input type="submit" hidden>
            </form>
            <ul>
                <li><a href="#">Поиск №1</a></li>
                <li><a href="#">Поиск №2</a></li>
                <li><a href="#">Поиск №356</a></li>
                <li><a href="#">Поиск №41331</a></li>
                <li><a href="#">Поиск №5</a></li>
            </ul>
            <a href="#" class="btn btn-light btn-filter_edit">Редактировать</a>
            <a href="#" class="btn btn-light btn-filter_delete">Удалить все</a>
        </div>
    </div>
</div>