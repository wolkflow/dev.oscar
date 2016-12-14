<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-12 col-lg-8 pb30">
    <? if (!empty($arResult['PICTURE'])) { ?>
        <div class="buyoutBlockTitle">
            <div class="buyoutBlockTitleText"><?= getMessage('GL_PICK_A_LICENSE') ?></div>
            <a href="javascript:void(0)" class="buyoutBlockTitleLink" id="js-buyout-picture-remove-id"><?= getMessage('GL_DELETE') ?></a>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="buyoutBlockImage">
                    <? $src = $arResult['PICTURE']['IMAGE_PREVIEW_SRC'] ?>
                    <? $alt = $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                    <img src="<?= $src ?>" alt="<?= $alt ?>" />
                </div>
                <div class="buyoutBlockName">
                    <?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                </div>
                <div class="buyoutBlockMeta">
                    <ul>
                        <li>
                            <b><?= getMessage('GL_AUTHOR') ?></b>
                            <?= $arResult['PICTURE']['AUTHOR'] ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_PLACE_CREATION') ?></b>
                            <?= implode(', ', $arResult['PICTURE']['PLACE']) ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_CREATION_TIME') ?></b>
                            <?= $arResult['PICTURE']['PERIOD'] ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_TECHNIQUE') ?></b>
                            <?= implode(', ', $arResult['PICTURE']['TECHNIQUES']) ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_DIMENSIONS') ?></b>
                            <?= number_format(($arResult['PICTURE'][Picture::FIELD_WIDTH] / 10), 1, ',', '') ?>
                            &times;
                            <?= number_format(($arResult['PICTURE'][Picture::FIELD_HEIGHT] / 10), 1, ',', '')  ?>
                            <?= getMessage('GL_CM') ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_COPYRIGHT_HOLDER') ?></b>
                            <?= $arResult['PICTURE']['HOLDER'] ?>
                        </li>
                        <li>
                            <b><?= getMessage('GL_CATEGORY') ?></b>
                            <?= $arResult['PICTURE']['COLLECTION']['TITLE'] ?>
                        </li>
                        <li>
                            <b>ID:</b> 
                            <?= $arResult['PICTURE'][Picture::FIELD_ID] ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5">
                <form class="buyoutParams">
                    <ul class="buyoutParamsRadio">
                        <? foreach ($arResult['LICENSES'] as $license) { ?>
                            <li>
                                <label>
                                    <input type="radio" name="license" class="js-license-root" value="<?= $license->getID() ?>" data-step="<?= $license->getStepTitle() ?>" data-price="<?= $license->getPrice() ?>" />
                                    <?= $license->getTitle() ?>
                                </label>
                            </li>
                        <? } ?>
                        <li>
                            <label>
                                <input type="radio" name="license" class="js-license-other" value="0" /> 
                                <?= getMessage('GL_MORE') ?>
                            </label>
                        </li>
                    </ul>
                    
                    <ul id="js-licenses-selects-id" class="buyoutParamsSelect"></ul>
                    
                    <div id="js-buyout-other-wrap-id" class="buyoutPrice hide">
                        <?= getMessage('GL_IF_YOU_HAVE_NOT_FOUND') ?>
                    </div>
                    
                    <div id="js-buyout-price-wrap-id" class="buyoutPrice hide">
                        <span id="js-buyout-price-id"></span>р.
                    </div>
                    <input id="js-buyout-submit-id" type="button" data-bid="<?= $arResult['BASKET']['ID'] ?>" data-pid="<?= $arResult['PICTURE']['ID'] ?>" class="btn btn-sm btn-default hide" value="<?= getMessage('GL_CONFIRM') ?>" />
                </form>
            </div>
        </div>
    <? } else { ?>
        <div class="buyout-no-select">
            <?= getMessage('GL_CLICK_IMAGE_LEFT') ?>
        </div>
    <? } ?>
</div>