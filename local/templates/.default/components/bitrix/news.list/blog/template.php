<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="categoryList">
    <? if (!empty($arResult['ITEMS'])) { ?>
		<? foreach ($arResult['ITEMS'] as $item) { ?>
			<article class="text">
				<div class="articleImage">
					<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="article-category">
						<img src="/i.php?src=<?= $item['PREVIEW_PICTURE']['SRC'] ?>&w=752&h=263" />
						<div class="articleTitle">
							<?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
						</div>
					</a>
					<a href="<?= $arResult['SECTIONS'][$item['IBLOCK_SECTION_ID']]['SECTION_PAGE_URL'] ?>" class="catmark">
						<?= $item['SECTION_LANG_TITLE'] ?>
					</a>
				</div>
				<div class="articleAnnotation">
					<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
						<?= $item['PROPERTIES']['LANG_SUBTITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
					</a>
				</div>
			</article>
		<? } ?>
	<? } else { ?>
        <p class="no-blogs">
            <?= getMessage('GL_NO_BLOG_TOPICS') ?>
        </p>
    <? } ?>
</div>