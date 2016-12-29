<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['PICTURE'])) { ?>
    <ol class="breadcrumb">
        <li><a href="/personal/"><?= getMessage('GL_PERSONAL_ACCOUNT') ?></a></li>
        <li><a href="/personal/"><?= getMessage('GL_DIRECTORY') ?></a></li>
        <li>
            <?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
        </li>
    </ol>

    <div class="row">
        <div class="card-image col-md-8 col-sm-7">
            <div class="card-image__container">
            
                <img src="<?= $arResult['PICTURE']['IMAGE_PREVIEW_SRC'] ?>" />
                
                <div class="card-image__stats">
                    <div class="card-image__stats-block card-image__stats-block--views">
                        <span><?= $arResult['STATISTIC']['VIEWS'] ?></span>
                        <span><?= getMessage('GL_VIEWS') ?></span>
                    </div>
                    <div class="card-image__stats-block card-image__stats-block--sells">
                        <span><?= $arResult['STATISTIC']['SALES'] ?></span>
                        <span><?= getMessage('GL_SALES') ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-right col-md-4 col-sm-5">
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
                    <?= implode(', ', $arResult['PICTURE']['PLACE']) ?>
                </span>
            </div>
            <div class="card-meta">
                <span class="card-meta__key"><?= getMessage('GL_CREATION_TIME') ?></span>
                <span class="card-meta__value">
                    <?= $arResult['PICTURE']['PERIOD'] ?>
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
                    <?= $arResult['PICTURE'][Picture::FIELD_ID] ?>
                </span>
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
        </div>
        <div class="card-left col-md-8 col-sm-7">
            <div class="card-description">
                <div class="card-description__title"><?= getMessage('GL_TYPE_SIZE_IMAGE') ?></div>
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
                            <?= $arResult['PICTURE'][Picture::FIELD_MODEL_SFX . CURRENT_LANG_UP] ?>
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
            <div class="card-right__edit">
                <a class="btn btn-light btn-filter_edit btn-inline" href="/personal/reload/<?= $arResult['PICTURE']['ID'] ?>/">
                    <?= getMessage('GL_EDIT') ?>
                </a>
            </div>
        </div>
    </div>
<? } else { ?>
        <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>