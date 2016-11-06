<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? use Glyf\Oscar\Collection; ?>

<? $sid = $arParams['DATA']['COLLECTION'] ?>

<? if (!empty($arResult['ROOT']['CHILDREN'])) { ?>
    <ul class="ddup">
        <? foreach ($arResult['ROOT']['CHILDREN'] as $section) { ?>
            <li>
                <? if (empty($section['CHILDREN'])) { ?>
                    <div class="ddtitle">
                        <label>
                            <input type="radio" name="COLLECTION" value="<?= $section['ID'] ?>" <?= ($section['ID'] == $sid) ? ('checked') : ('') ?> />
                            <?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                        </label>
                    </div>
                <? } else { ?>
                    <div class="ddtitle ddparent">
                        <?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                    </div>
                    <ul class="ddlist">
                        <? foreach ($section['CHILDREN'] as $subsection) { ?>
                            <? if (empty($subsection['CHILDREN'])) { ?>
                                <div class="ddtitle">
                                    <label>
                                        <input type="radio" name="COLLECTION" value="<?= $subsection['ID'] ?>" <?= ($subsection['ID'] == $sid) ? ('checked') : ('') ?> />
                                        <?= $subsection['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                                    </label>
                                </div>
                            <? } else { ?>
                                <div class="ddtitle ddparent">
                                    <?= $subsection['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                                </div>
                                <ul class="ddlist">
                                    <? foreach ($subsection['CHILDREN'] as $subsubsection) { ?>
                                        <div class="ddtitle">
                                            <label>
                                                <input type="radio" name="COLLECTION" value="<?= $subsubsection['ID'] ?>" <?= ($subsubsection['ID'] == $sid) ? ('checked') : ('') ?> />
                                                <?= $subsubsection['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                                            </label>
                                        </div>
                                    <? } ?>
                                </ul>
                            <? } ?>
                        <? } ?>
                    </ul>
                <? } ?>
            </li>
        <? } ?>
    </ul>
<? } ?>
