<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-12 col-lg-8 pb30">
    <? if (!empty($arResult['PICTURE'])) { ?>
        <div class="buyoutBlockTitle">
            <div class="buyoutBlockTitleText">выбрать лицензию</div>
            <a href="javascript:void(0)" class="buyoutBlockTitleLink" id="js-buyout-picture-remove-id">удалить</a>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="buyoutBlockImage">
                    <? $src = $arResult['PICTURE']['IMAGE_PREVIEW_SRC'] ?>
                    <? $alt = $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                    <img src="<?= $src ?>" alt="<?= $alt ?>" />
                </div>
                <div class="buyoutBlockName">Богатыри</div>
                <div class="buyoutBlockMeta">
                    <ul>
                        <li>
                            <b>Автор:</b> 
                            <?= $arResult['PICTURE']['AUTHOR'] ?>
                        </li>
                        <li>
                            <b>Место создания:</b> 
                            <?= implode(', ', $arResult['PICTURE']['PLACE']) ?>
                        </li>
                        <li>
                            <b>Время создания:</b>
                            <?= $arResult['PICTURE']['PERIOD'] ?>
                        </li>
                        <li>
                            <b>Техника:</b>
                            <?= implode(', ', $arResult['PICTURE']['TECHNIQUES']) ?>
                        </li>
                        <li>
                            <b>Размеры:</b> 
                            <?= number_format(($arResult['PICTURE'][Picture::FIELD_WIDTH] / 10), 1, ',', '') ?>
                            &times;
                            <?= number_format(($arResult['PICTURE'][Picture::FIELD_HEIGHT] / 10), 1, ',', '')  ?>
                            см
                        </li>
                        <li>
                            <b>Правообладатель:</b>
                            <?= $arResult['PICTURE']['HOLDER'] ?>
                        </li>
                        <li>
                            <b>Категория:</b> 
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
                                    <input type="radio" name="license" class="js-license-root" value="<?= $license->getID() ?>" data-step="<?= $license->getStepTitle() ?>" />
                                    <?= $license->getTitle() ?>
                                </label>
                            </li>
                        <? } ?>
                        <li>
                            <label>
                                <input type="radio" name="license" class="js-license-other" value="0" /> 
                                Другое
                            </label>
                        </li>
                    </ul>
                    
                    <ul id="js-licenses-selects-id" class="buyoutParamsSelect">
                        <? /*
                        <li>
                            <label for="buyoutType">Retail Book</label>
                            <select name="" id="buyoutType" class="styler">
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                            </select>
                        </li>
                        <li>
                            <label for="buyoutFormat">Формат</label>
                            <select name="" id="buyoutFormat" class="styler">
                                <option value="">Print</option>
                                <option value="">Print</option>
                                <option value="">Print</option>
                            </select>
                        </li>
                        <li>
                            <label for="buyoutRegion">Регион</label>
                            <select name="" id="buyoutRegion" class="styler">
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                            </select>
                        </li>
                        <li>
                            <label for="buyoutSize">Размер</label>
                            <select name="" id="buyoutSize" class="styler">
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                                <option value="">Retail Book</option>
                            </select>
                        </li>
                        */ ?>
                    </ul>
                    
                    <div id="js-buyout-price-wrap-id" class="buyoutPrice hide">
                        <span id="js-buyout-price-id"></span>р.
                    </div>
                    <input id="js-buyout-submit-id" type="submit" class="btn btn-sm btn-default hide" value="Подтвердить" />
                </form>
            </div>
        </div>
    <? } else { ?>
        <div class="buyout-no-select">
            Для покупки кликните на изображение слева.
        </div>
    <? } ?>
</div>