<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Subscribe ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="subscribeBlock">
    <div class="container">
        <h1>
            <?= getMessage('GL_SUBSCRIBES') ?>
        </h1>
        <div class="col-lg-8 col-lg-offset-2">
            <p>
                <?  // Текст о подписках.
                    $APPLICATION->IncludeComponent('bitrix:main.include', '', array(
                        'AREA_FILE_SHOW' => 'file',
                        'PATH' => SITE_TEMPLATE_PATH.'/include/data/'.CURRENT_LANG.'/subscribes.php',
                        'EDIT_TEMPLATE' => 'html',
                    ), $component);
                ?>
            </p>
        </div>
    </div>
</div>

<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="subscribeCol subscribeCol-1">
                            <div class="subscribeCol-top">
                                <div class="subscribeCol-title">
                                    <?= getMessage('GL_COLLECTIONS') ?>:
                                </div>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/images/subscribe.png" />
                            </div>
                            <div class="subscribeCol-list">
                                <ul>
                                    <? foreach ($arResult['KINDS']['COLLECTIONS'] as $id => $title) { ?>
                                        <li>
                                            <label>
                                                <input type="checkbox" name="COLLECTIONS[]" value="<?= $id ?>" <?= (in_array($id, $arResult['DATA']['COLLECTIONS'])) ? ('checked') : ('') ?> />
                                                <?= $title ?>
                                            </label>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="subscribeCol subscribeCol-1">
                            <div class="subscribeCol-top">
                                <div class="subscribeCol-title">
                                    <?= getMessage('GL_BLOG') ?>:
                                </div>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/images/subscribe.png" />
                            </div>
                            <div class="subscribeCol-list">
                                <ul>
                                    <? foreach ($arResult['KINDS']['BLOGS'] as $id => $title) { ?>
                                        <li>
                                            <label>
                                                <input type="checkbox" name="BLOGS[]" value="<?= $id ?>" <?= (in_array($id, $arResult['DATA']['BLOGS'])) ? ('checked') : ('') ?> />
                                                <?= $title ?>
                                            </label>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="subscribeSearch">
                    <div class="row">
                        <div class="col-md-6 subscribeSearch-col">
                                <div class="subscribeSearch-title-out">
                                    <div class="subscribeSearch-title-inner">
                                        <?= getMessage('GL_SEARCHES') ?>:
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6 subscribeSearch-col">
                            <div class="subscribeSearch-list">
                                <div class="row">
                                    <? $count  = count($arResult['KINDS']['SEARCHES']) ?>
                                    <? $count  = ($count % 2 == 0) ? ($count / 2) : ($count / 2 + 1) ?>
                                    <? $chunks = array_chunk($arResult['KINDS']['SEARCHES'], $count, true) ?>
                                    
                                    <div class="col-xs-6">
                                        <ul>
                                            <? $searches = $chunks[0] ?>
                                            <? foreach ($searches as $id => $title) { ?>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="SEARCHES[]" value="<?= $id ?>" <?= (in_array($id, $arResult['DATA']['SEARCHES'])) ? ('checked') : ('') ?> />
                                                        <?= $title ?>
                                                    </label>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6">
                                        <ul>
                                            <? $searches = $chunks[1] ?>
                                            <? foreach ($searches as $id => $title) { ?>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="SEARCHES[]" value="<?= $id ?>" <?= (in_array($id, $arResult['DATA']['SEARCHES'])) ? ('checked') : ('') ?> />
                                                        <?= $title ?>
                                                    </label>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="subscribePeriod">
                    <div class="subscribePeriod-title">
                        <?= getMessage('GL_CHOOES_FREQUENTLY') ?>
                    </div>
                    <div class="subscribePeriod-radio">
                        <? foreach ($arResult['PERIODS'] as $period) { ?>
                            <label>
                                <input type="radio" name="PERIOD" value="<?= $period['ID'] ?>" class="styler" <?= ($arResult['DATA']['PERIOD'] == $period['ID']) ? ('checked') : ('') ?> />
                                <?= getMessage('GL_' . $period['CODE']) ?>
                            </label>
                        <? } ?>
                    </div>
                </div>

                <div class="subscribeConfirm">
                    <button type="submit" name="ACTION" value="CONFIRM" class="btn btn-confirm">
                        <?= getMessage('GL_CONFIRM') ?>
                    </button>
                    <button type="submit" name="ACTION" value="DECLINE" class="btn btn-decline">
                        <?= getMessage('GL_DECLINE') ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>