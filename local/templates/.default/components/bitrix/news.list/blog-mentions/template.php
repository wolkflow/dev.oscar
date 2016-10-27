<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="card-description hidden-xs">
        <div class="card-description__title">
            <?= getMessage('GL_BLOG_MENTIONS') ?>
        </div>
        <div class="card-description__text">
            <div class="archiveList">
                <? foreach ($arResult['ITEMS'] as $item) { ?>
                    <article class="archiveArticle text">
                        <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                            <div class="archiveArticleImage">
                                <img src="/i.php?src=<?= $item['PREVIEW_PICTURE']['SRC'] ?>&w=340&h=97" />
                                <div class="catmark">
                                    <?= $item['SECTION_LANG_TITLE'] ?>
                                </div>
                            </div>
                            <p>
                                <?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
                            </p>
                        </a>
                    </article>
                <? } ?>
            </div>
        </div>
    </div>
<? } ?>