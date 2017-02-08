<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? $GLOBALS['JSVARS']['LANGS']['FILE_NOTE'] = getMessage('GL_FILE_NOTE') ?>

<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.autocomplete.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-submit').on('click', function(event) {
            $(this).closest('form').submit();
        });
        
        $('#js-param-place-country-id').on('keydown', function(event) {
            $('#js-param-country-id').val('');
            $('#js-param-city-id').val('');
        }).autocomplete({
            source: function(request, callback) {
                var $item = $(this.element[0]);
                
                $.ajax({
                    url: '/remote/',
                    dataType: 'json',
                    data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                    success: function(response) {
                        if (response.status) {
                            callback(response.data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                $($(this).data('input')).val(ui.item.id);
            },
            minLength: 2
        });
        
        
        $('#js-param-place-city-id').on('keydown', function(event) {
            $('#js-param-city-id').val('');
        }).autocomplete({
            change: function(event, ui) {
                // $('#js-param-city-id').val('');
            },
            source: function(request, callback) {
                var $item = $(this.element[0]);
                
                $.ajax({
                    url: '/remote/',
                    dataType: 'json',
                    data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term, 'country': parseInt($('#js-param-country-id').val())},
                    success: function(response) {
                        if (response.status) {
                            callback(response.data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                $($(this).data('input')).val(ui.item.id);
            },
            minLength: 2
        });
        
        
        $('.suggest').autocomplete({
            source: function(request, callback) {
                var $item = $(this.element[0]);
                
                $.ajax({
                    url: '/remote/',
                    dataType: 'json',
                    data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                    success: function(response) {
                        if (response.status) {
                            callback(response.data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                $($(this).data('input')).val(ui.item.id);
            },
            minLength: 2
        });
        
        
        $('.suggest-tags').on('keydown', function(event) {
            var $that = $(this);
            var $wrap = $that.closest('.js-suggest-tags-wrap');
            var $tags = $wrap.find('.tags');
            var param = $wrap.data('param');
            var value = $that.val();
            var istag = false;
            
            
            if (event.key == ',') {
                istag = true;
            }
            
            if (event.key == 'Enter' || event.keyCode == 13) {
                istag = true;
            }
            
            if (value.length <= 0) {
                return;
            }
            value = value.trim().toLowerCase();
            
            if (istag) {
                if ($wrap.find('.tag').filter(function() { return $(this).text().trim() == value; }).length <= 0) {
                    var tag = ' ';
                    
                    tag += '<div class="tag">';
                    tag += '<input type="hidden" name="' + param + '_TITLE[]" value="' + value + '" />';
                    tag += value;
                    tag += '<span class="close"></span>';
                    tag += '</div>';
                    
                    $tags.append(tag);
                }
                
                $that.val('');
                event.preventDefault();
                return false;
            }
        }).autocomplete({
            source: function(request, callback) {
                var $that = $(this.element[0]);
                var $wrap = $that.closest('.js-suggest-tags-wrap');
                
                $.ajax({
                    url: '/remote/',
                    dataType: 'json',
                    data: {'action': 'dictionary-' + $that.data('type') + '-suggest', 'text': request.term},
                    success: function(response) {
                        if (response.status) {
                            callback(response.data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                var $that = $(this);
                var $wrap = $(this).closest('.js-suggest-tags-wrap');
                var $tags = $wrap.find('.tags');
                var param = $wrap.data('param');
                var value = ui.item.value.trim().toLowerCase();
                
                $that.val('');
                
                if (value.length <= 0) {
                    this.close();
                    return false;
                }
                
                if ($wrap.find('.tag').filter(function() { return $(this).text().trim() == value; }).length > 0) {
                    $that.autocomplete('close');
                    return false;
                }
                
                var tag = ' ';
                
                tag += '<div class="tag">';
                tag += '<input type="hidden" name="' + param + '[' + ui.item.id + ']" value="' + value + '" />';
                tag += value;
                tag += '<span class="close"></span>';
                tag += '</div>';
                
                $tags.append(tag);
                $that.val('');
                
                return false;
            },
            minLength: 2
        });
        
        $(document).on('click', '.tag .close', function() {
            $(this).closest('.tag').remove();
        });
    });
</script>

<? $editmode = ($arParams['PID'] > 0) ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <? if ($editmode) { ?>
                <h1><?= getMessage('GL_HEADER_RELOAD') ?></h1>
            <? } else { ?>
                <h1><?= getMessage('GL_HEADER_UPLOAD') ?></h1>
            <? } ?>
            
            <? if (!empty($arResult['ERRORS'])) { ?>
                <div class="errros">
                    <?= implode('<br/>', $arResult['ERRORS']) ?>
                </div>
            <? } ?>
            
            <form id="js-picture-upload-form-id" method="post" class="form uploadForm" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?= $arResult['DATA']['ID'] ?>" />
                
                <? // Файл с изображением // ?>
                <? if ($editmode) { ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="reload-image">
                                <img src="<?= $arResult['PICTURE']['SRC'] ?>" />
                            </div>
                        </div>
                    </div>
                    <? if (!$arResult['DATA']['MODERATE'] && !empty($arResult['DATA']['MODERATE_TEXT'])) { ?>
                        <div class="moderate-text">
                            <b><?= getMessage('GL_MODERATION') ?>:</b>
                            <?= $arResult['DATA']['MODERATE_TEXT'] ?>
                        </div>
                    <? } ?>
                <? } else { ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="file" name="FILE" class="styler" placeholder="<?= getMessage('GL_FILE_NOTE') ?>" />
                        </div>
                    </div>
                <? } ?>
                
                
                <? // Директория // ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="uploadBlock">
                            <label class="uploadBlock-title">
                                <input type="radio" name="FOLDER_SET" value="EXIST" <?= (empty($arResult['PARAMS']['FOLDERS'])) ? ('disabled') : ('') ?> <?= ($arResult['DATA']['FOLDER_SET'] == 'EXIST') ? ('checked') : ('') ?> />
                                <?= getMessage('GL_PLACED_FOLDER') ?>
                            </label>
                            <? if (!empty($arResult['PARAMS']['FOLDERS'])) { ?>
                                <select name="FOLDER_ID" class="styler">
                                    <? foreach ($arResult['PARAMS']['FOLDERS'] as $id => $title) { ?>
                                        <option value="<?= $id ?>" <?= ($id == $arResult['DATA']['FOLDER']) ? ('selected') : ('') ?>>
                                            <?= $title ?>
                                        </option>
                                    <? } ?>
                                </select>
                            <? } else { ?>
                                <?= getMessage('GL_MOMENT_FOLDERS') ?>
                            <? } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="uploadBlock">
                            <label class="uploadBlock-title">
                                <input type="radio"  name="FOLDER_SET" value="CREATE" <?= ($arResult['DATA']['FOLDER_SET'] == 'CREATE') ? ('checked') : ('') ?> />
                                <?= getMessage('GL_NEW_FOLDER') ?>
                            </label>
                            <input type="text" name="FOLDER_TITLE" value="<?= $arResult['DATA']['FOLDER_TITLE'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_1') ?>" /> 
                        </div>
                    </div>
                </div>
                
                
                <? // Параметры объекта // ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="uploadRowTitle">
                            <?= getMessage('GL_OBJECT_PARAMETERS') ?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_NAME_OBJECT') ?>
                            </div>
                            <input type="text" name="TITLE" value="<?= $arResult['DATA']['TITLE'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_2') ?>" />
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_AUTHOR') ?>
                            </div>
                            <input type="hidden" id="js-param-author-id" name="AUTHOR_ID" value="<?= $arResult['DATA']['AUTHOR_ID'] ?>" />
                            <input type="text" class="suggest" data-type="author" data-input="#js-param-author-id" name="AUTHOR_TITLE" value="<?= $arResult['DATA']['AUTHOR_TITLE'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_2A') ?>" />
                        </div>
                    </div>
                    <div class="col-xs-12 uploadPeriod">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="uploadBlock">
                                    <div class="uploadBlock-title">
                                        <?= getMessage('GL_DATE_2') ?>
                                        <label class="inline-label">
                                            <input type="radio" name="ISYEAR" value="YEAR" <?= ($arResult['DATA']['ISYEAR'] == 'YEAR' || empty($arResult['DATA']['ISYEAR'])) ? ('checked') : ('') ?> />
                                            <?= getMessage('GL_YEAR') ?>
                                        </label> 
                                        <label class="inline-label">
                                            <input type="radio"  name="ISYEAR" value="CENTURY" <?= ($arResult['DATA']['ISYEAR'] == 'CENTURY') ? ('checked') : ('') ?> />
                                            <?= getMessage('GL_CENTURY') ?>
                                        </label>
                                    </div>
                                    <div class="upload-double">
                                        <input type="text" name="PERIOD" value="<?= $arResult['DATA']['PERIOD'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_YEAR') ?>" />
                                        <select class="styler" name="PERIOD_ERA">
                                            <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_AD') ?>
                                            </option>
                                            <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_ERA'] == Picture::PROP_TIME_BC) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_BC') ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"><span class="uploadPeriod-divider"><?= getMessage('GL_OR') ?></span></div>
                            <div class="col-md-3">
                                <div class="uploadBlock">
                                    <div class="uploadBlock-title"><?= getMessage('GL_FROM') ?></div>
                                    <div class="upload-double">
                                        <input type="text" name="PERIOD_FROM" value="<?= $arResult['DATA']['PERIOD_FROM'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_CENTURY') ?>" />
                                        <select class="styler" name="PERIOD_FROM_ERA">
                                            <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_AD') ?>
                                            </option>
                                            <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_BC) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_BC') ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="uploadBlock">
                                    <div class="uploadBlock-title"><?= getMessage('GL_TO') ?></div>
                                    <div class="upload-double">
                                        <input type="text" name="PERIOD_TO" value="<?= $arResult['DATA']['PERIOD_TO'] ?>" placeholder="<?= getMessage('GL_EXAMPLE_CENTURY') ?>" />
                                        <select class="styler" name="PERIOD_TO_ERA">
                                            <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_AD') ?>
                                            </option>
                                            <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_BC) ? ('selected') : ('') ?>>
                                                <?= getMessage('GL_BC') ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="uploadBlock js-suggest-tags-wrap" data-param="TECHNIQUE">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_TECHNIQUE') ?>
                            </div>
                            <input type="text" class="suggest-tags" data-type="technique" placeholder="<?= getMessage('GL_EXAMPLE_3') ?>" />
                            <div class="tags">
                                <? if (!empty($arResult['DATA']['TECHNIQUE'])) { ?>
                                    <? foreach ($arResult['DATA']['TECHNIQUE'] as $id => $value) { ?>
                                        <div class="tag">
                                            <input type="hidden" name="TECHNIQUE[<?= $id ?>]" value="<?= $value ?>" />
                                            <?= $value ?> 
                                            <span class="close"></span>
                                        </div>
                                    <? } ?>
                                <? } ?>
                                <? if (!empty($arResult['DATA']['TECHNIQUE_TITLE'])) { ?>
                                    <? foreach ($arResult['DATA']['TECHNIQUE_TITLE'] as $id => $value) { ?>
                                        <div class="tag">
                                            <input type="hidden" name="TECHNIQUE_TITLE[]" value="<?= $value ?>" />
                                            <?= $value ?> 
                                            <span class="close"></span>
                                        </div>
                                    <? } ?>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="uploadBlock uploadBlock-description">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_DESCRIPTION') ?>
                            </div>
                            <textarea name="DESCRIPTION"><?= $arResult['DATA']['DESCRIPTION'] ?></textarea>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <? // Коллекция // ?>
                    <div class="col-md-6 uploadTypeWrap">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title uploadBlock-title_bold">
                                <?= getMessage('GL_COLLECTION_NO_LIGHTBOX') ?>
                            </div>
                            
                            <?	// Коллекции.
                                $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section.list",
                                    "collections-upload",
                                    array(
                                        "DATA" => $arResult['DATA'],
                                        "VIEW_MODE" => "TEXT",
                                        "SHOW_PARENT_NAME" => "N",
                                        "IBLOCK_TYPE" => "products",
                                        "IBLOCK_ID" => "4",
                                        "SECTION_ID" => "",
                                        "SECTION_CODE" => "",
                                        "SECTION_URL" => "",
                                        "COUNT_ELEMENTS" => "N",
                                        "TOP_DEPTH" => "4",
                                        "SECTION_FIELDS" => "",
                                        "SECTION_USER_FIELDS" => array("UF_LANG_TITLE_RU", "UF_LANG_TITLE_EN"),
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "36000",
                                        "CACHE_NOTES" => "",
                                        "CACHE_GROUPS" => "Y"
                                    ),
                                    $component
                                );
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title uploadBlock-title_bold">
                                <?= getMessage('GL_GENRE') ?>
                            </div>
                            <ul class="ddup">
                                <? foreach ($arResult['PARAMS']['GENRE'] as $id => $code) { ?>
                                    <li>
                                        <label>
                                            <input type="radio" name="GENRE" value="<?= $id ?>" <?= ($id == $arResult['DATA']['GENRE']) ? ('checked') : ('') ?> />
                                            <?= getMessage('GL_GENRE_' . $code) ?>
                                        </label>
                                    </li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 uploadBlock">
                        <div class="uploadBlock-size">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_PLACE_CREATION') ?>
                            </div>
                            <input type="text" id="js-param-place-country-id" name="COUNTRY" data-type="place-country" data-input="#js-param-country-id" value="<?= $arResult['DATA']['COUNTRY'] ?>" placeholder="<?= getMessage('GL_COUNTRY') ?>" />
                            <input type="text" id="js-param-place-city-id" name="CITY" data-type="place-city" data-input="#js-param-city-id" value="<?= $arResult['DATA']['CITY'] ?>" placeholder="<?= getMessage('GL_CITY') ?>" />
                            
                            <input type="hidden" id="js-param-country-id" name="COUNTRY_ID" value="<?= $arResult['DATA']['COUNTRY_ID'] ?>" />
                            <input type="hidden" id="js-param-city-id" name="CITY_ID" value="<?= $arResult['DATA']['CITY_ID'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 uploadBlock-size">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_OBJECT_SIZE') ?>
                            </div>
                            <input type="text" name="HEIGHT" value="<?= $arResult['DATA']['HEIGHT'] ?>" placeholder="<?= getMessage('GL_HEIGHT') ?>" />
                            <input type="text" name="WIDTH" value="<?= $arResult['DATA']['WIDTH'] ?>" placeholder="<?= getMessage('GL_WIDTH') ?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="uploadBlock uploadColor">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_COLOR_IMAGE') ?>
                            </div>
                            <ul class="ddup">
                                <? foreach ($arResult['PARAMS']['COLOR'] as $id => $code) { ?>
                                    <li>
                                        <label>
                                            <input type="radio" name="COLOR" value="<?= $id ?>" <?= ($id == $arResult['DATA']['COLOR']) ? ('checked') : ('') ?> />
                                            <?= getMessage('GL_COLOR_' . $code) ?>
                                        </label>
                                    </li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="uploadBlock uploadCopy">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_LEGAL_REGIME') ?>
                            </div>
                            <ul class="ddup">
                                <? foreach ($arResult['PARAMS']['LEGAL'] as $id => $code) { ?>
                                    <li>
                                        <label>
                                            <input type="radio" name="LEGAL" value="<?= $id ?>" <?= ($id == $arResult['DATA']['LEGAL']) ? ('checked') : ('') ?> />
                                            <?= getMessage('GL_LEGAL_' . $code) ?>
                                        </label>
                                    </li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="uploadBlock uploadKeywords js-suggest-tags-wrap" data-param="KEYWORDS">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_KEYWORDS') ?>
                            </div>
                            <input type="text" class="suggest-tags" data-type="keywords" placeholder="<?= getMessage('GL_EXAMPLE_4') ?>" />
                            <div class="tags">
                                <? if (!empty($arResult['DATA']['KEYWORDS'])) { ?>
                                    <? foreach ($arResult['DATA']['KEYWORDS'] as $id => $value) { ?>
                                        <div class="tag">
                                            <input type="hidden" name="KEYWORDS[<?= $id ?>]" value="<?= $value ?>" />
                                            <?= $value ?> 
                                            <span class="close"></span>
                                        </div>
                                    <? } ?>
                                <? } ?>
                                <? if (!empty($arResult['DATA']['KEYWORDS_TITLE'])) { ?>
                                    <? foreach ($arResult['DATA']['KEYWORDS_TITLE'] as $id => $value) { ?>
                                        <div class="tag">
                                            <input type="hidden" name="KEYWORDS_TITLE[]" value="<?= $value ?>" />
                                            <?= $value ?> 
                                            <span class="close"></span>
                                        </div>
                                    <? } ?>
                                <? } ?>
                            </div>
                        
                            <? /*
                            <div class="uploadBlock-title">Ключевые слова</div>
                            <textarea name="KEYWORDS" placeholder="пример: Живопись, Пейзаж, ХХ век"><?= $arResult['DATA']['KEYWORDS'] ?></textarea>
                            */ ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 uploadBlock-areas">
                        <div class="uploadBlock">
                            <div class="uploadBlock-title">
                                <?= getMessage('GL_ADDITIONAL_INFORMATION') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_PROVENANCE') ?></div>
                                    <textarea name="PROVENANCE"><?= $arResult['DATA']['PROVENANCE'] ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_MODEL') ?></div>
                                    <textarea name="MODEL"><?= $arResult['DATA']['MODEL'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_RESTORATION_WORK') ?></div>
                                    <textarea name="RESTORATION"><?= $arResult['DATA']['RESTORATION'] ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_SKETCHES') ?></div>
                                    <textarea name="SKETCHES"><?= $arResult['DATA']['SKETCHES'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_TECHNICAL_CONDITION') ?></div>
                                    <textarea name="TECHNICAL"><?= $arResult['DATA']['TECHNICAL'] ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_OTHER') ?></div>
                                    <textarea name="OTHER"><?= $arResult['DATA']['OTHER'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="uploadBlock-title_small"><?= getMessage('GL_CUSTOMER') ?></div>
                                    <textarea name="CUSTOMER"><?= $arResult['DATA']['CUSTOMER'] ?></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" class="btn btn-upload button-submit js-submit" value="<?= getMessage('GL_SAVE') ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>