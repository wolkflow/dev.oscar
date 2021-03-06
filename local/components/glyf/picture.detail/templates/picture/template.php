<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['PICTURE'])) { ?>
    <div class="col-md-9 col-sm-9">
        
        <ol class="breadcrumb">
            <? $lastitem = array_pop($arResult['NAVIGATION']) ?>
            <? foreach ($arResult['NAVIGATION'] as $item) { ?>
                <li>
                    <a href="<?= $item['LINK'] ?>">
                        <?= $item['TITLE'] ?>
                    </a>
                </li>
            <? } ?>
            <li class="last">
                <a href="<?= $lastitem['LINK'] ?>">
                    <?= $lastitem['TITLE'] ?>
                </a>
            </li>
        </ol>
        
        <div class="row card">
            <div class="col-md-8 col-sm-7">
                <div class="card-image__container">
                    <? $src = ($arResult['ACCESS']['WATERMARK']) ? ($arResult['PICTURE']['IMAGE_PREVIEW_SRC']) : ($arResult['PICTURE']['IMAGE_PREVIEW_WATERMAK_SRC']) ?>
                    <? if ($arResult['ACCESS']['ZOOM']) { ?>
                        <img
                            src="<?= $src ?>" 
                            alt="<?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>"
                            data-pid="<?= $arResult['PICTURE'][Picture::FIELD_ID] ?>"
                            data-zoom-image="<?= $src ?>"
                        />
                    <? } else { ?>
                        <img 
                            src="<?= $src ?>" 
                            alt="<?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>"
                            data-pid="<?= $arResult['PICTURE'][Picture::FIELD_ID] ?>"
                        />
                    <? } ?>
                    <div class="card-image__buttons">
                        <? if ($arResult['PICTURE'][Picture::FIELD_LEGAL] == Picture::PROP_LEGAL_NOCOMMERCIAL_ID) { ?>
                            <a class="card-image__button card-image__button--copyright" href="javascript:void(0)" title="<?= getMessage('GL_NON_COMMERCIAL') ?>"></a>
                        <? } ?>
                        <a class="card-image__button card-image__button--add js-add-to-lightbox" href="javascript:void(0)" data-pid="<?= $arResult['PICTURE'][Picture::FIELD_ID] ?>"></a>
                        <a class="card-image__button card-image__button--cart js-add-to-cart" href="javascript:void(0)" data-pid="<?= $arResult['PICTURE'][Picture::FIELD_ID] ?>"></a>
                    </div>
                </div>

                <div class="card-description">
                    <div class="card-description__title">
                        <?= getMessage('GL_TYPE_AND_SIZE') ?>
                    </div>
                    <div class="card-description__text card-description__text--big">
                        <?= strtoupper($arResult['PICTURE']['FILE']['EXT']) ?>, 
                        <?= round($arResult['PICTURE']['FILE']['SIZE'], 2) ?>MB, 
                        <?= round($arResult['PICTURE']['FILE']['WIDTH'], 2) ?>px &times; 
                        <?= round($arResult['PICTURE']['FILE']['HEIGHT'], 2) ?>px
                    </div>
                </div>
                <div class="card-description">
                    <div class="card-description__title"><?= getMessage('GL_DESCRIPTION') ?></div>
                    <div class="card-description__text">
                        <?= $arResult['PICTURE'][Picture::FIELD_LANG_DESC_SFX . CURRENT_LANG_UP] ?>
                    </div>
                </div>
                
                <? if ($arResult['ACCESS']['INFO']) { ?>
                    <div class="card-description">
                        <div class="card-description__title"><?= getMessage('GL_ADDITIONAL_INFORMATION') ?></div>
                        <div class="card-description__text">
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_PROVENANCE') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_PROVENANCE_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_RESTORATION_WORK') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_RESTORATION_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_TECHNICAL_CONDITION') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_TECHNICAL_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_CUSTOMER') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_CUSTOMER_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_MODEL') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_RESTORATION_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_SKETCHES') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_SKETCHES_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                            <div class="card-meta">
                                <span class="card-meta__key"><?= getMessage('GL_OTHER') ?></span>
                                <span class="card-meta__value">
                                    <?= $arResult['PICTURE'][Picture::FIELD_OTHER_SFX . CURRENT_LANG_UP] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="col-md-4 col-sm-5">
                <h1>
                    <?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                </h1>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_AUTHOR') ?></span>
                    <span class="card-meta__value">
                        <? if (!empty($arResult['PICTURE']['AUTHOR'])) { ?>
                            <?= $arResult['PICTURE']['AUTHOR'] ?>
                        <? } else { ?>
                            <?= getMessage('GL_NOT_ASCERTAINED') ?>
                        <? } ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_PLACE_CREATION') ?></span>
                    <span class="card-meta__value">
                        <? $place = implode(', ', $arResult['PICTURE']['PLACE']) ?>
                        <? if (!empty($place)) { ?>
                            <?= $place ?>
                        <? } else { ?>
                            <?= getMessage('GL_NOT_ASCERTAINED') ?>
                        <? } ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_CREATION_TIME') ?></span>
                    <span class="card-meta__value">
                        <? if (!empty($arResult['PICTURE']['PERIOD'])) { ?>
                            <?= $arResult['PICTURE']['PERIOD'] ?>
                        <? } else { ?>
                            <?= getMessage('GL_NOT_ASCERTAINED') ?>
                        <? } ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_TECHNIQUE') ?></span>
                    <span class="card-meta__value">
                        <?= implode(', ', $arResult['PICTURE']['TECHNIQUES']) ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_DIMENSIONS') ?></span>
                    <span class="card-meta__value">
                        <? if (!empty($arResult['PICTURE'][Picture::FIELD_WIDTH]) || !empty($arResult['PICTURE'][Picture::FIELD_HEIGHT])) { ?>
                            <? if (!empty($arResult['PICTURE'][Picture::FIELD_WIDTH]) && !empty($arResult['PICTURE'][Picture::FIELD_HEIGHT])) { ?>
                                <?= number_format($arResult['PICTURE'][Picture::FIELD_WIDTH], 1, ',', '') ?>
                                &times;
                                <?= number_format($arResult['PICTURE'][Picture::FIELD_HEIGHT], 1, ',', '')  ?>
                            <? } else { ?>
                                <? if (!empty($arResult['PICTURE'][Picture::FIELD_WIDTH])) { ?>
                                    <?= number_format($arResult['PICTURE'][Picture::FIELD_WIDTH], 1, ',', '') ?>
                                <? } ?>
                                <? if (!empty($arResult['PICTURE'][Picture::FIELD_HEIGHT])) { ?>
                                    <?= number_format($arResult['PICTURE'][Picture::FIELD_HEIGHT], 1, ',', '')  ?>
                                <? } ?>
                            <? } ?>
                            <?= getMessage('GL_CM') ?>
                        <? } else { ?>
                            <?= getMessage('GL_NOT_ASCERTAINED') ?>
                        <? } ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_COPYRIGHT_HOLDER') ?></span>
                    <span class="card-meta__value">
                        <?= $arResult['PICTURE']['HOLDER'] ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key"><?= getMessage('GL_CATEGORY') ?></span>
                    <span class="card-meta__value">
                        <?= $arResult['PICTURE']['COLLECTION']['TITLE'] ?>
                    </span>
                </div>
                <div class="card-meta">
                    <span class="card-meta__key">ID:</span>
                    <span class="card-meta__value">
                        <?= $arResult['PICTURE']['VIEWID'] ?>
                    </span>
                </div>
                <div class="card-right__add-to-cart">
                    <? if ($arResult['ACCESS']['DOWNLOAD']) { ?>
                        <a id="js-download-id" class="btn btn-blue" href="javascript:void(0)" data-pid="<?= $arResult['PICTURE']['ID'] ?>">
                            <?= getMessage('GL_DOWNLOAD') ?>
                        </a>
                    <? } ?>
                    <? if ($arResult['ACCESS']['BUY']) { ?>
                        <a class="btn js-add-to-cart" href="javascript:void(0)" data-pid="<?= $arResult['PICTURE'][Picture::FIELD_ID] ?>">
                            <?= getMessage('GL_ADD_TO_CART') ?>
                        </a>
                    <? } ?>
                </div>
                <div class="card-description hidden-xs">
                    <div class="card-description__title"><?= getMessage('GL_KEYWORDS') ?></div>
                    <div class="card-description__text">
                        <?  // Ключевые слова.
                            $keywords = array();
                            foreach ($arResult['PICTURE']['KEYWORDS'] as $keyword) {
                                $keywords []= '<a href="/search/?F[KEYWORDS]=' . $keyword . '">' . $keyword . '</a>';
                            }
                        ?>
                        <?= implode(', ', $keywords) ?>
                    </div>
                </div>
                
                <?  // Упоминания в блоге.
                    $GLOBALS['arBlogTagFilter'] = array(
                        'PROPERTY_LANG_TAGS_' . CURRENT_LANG_UP => $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP]
                    );
                    
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "blog-mentions",
                        array(
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => "3",
                            "NEWS_COUNT" => "6",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER2" => "DESC",
                            "FILTER_NAME" => "arBlogTagFilter",
                            "FIELD_CODE" => array(),
                            "PROPERTY_CODE" => array("*"),
                            "PARENT_SECTION_CODE" => "",
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "86400",
                            "CACHE_FILTER" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "0",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "DISPLAY_PANEL" => "N",
                            "SET_TITLE" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "DISPLAY_TOP_PAGER"	=> "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y"
                        ),
                        $component
                    );
                ?>
            </div>
        </div>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>