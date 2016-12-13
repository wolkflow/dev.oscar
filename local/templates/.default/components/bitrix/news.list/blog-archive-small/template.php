<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-4 col-md-4 hidden-xs">
    <? if (!empty($arResult['ITEMS'])) { ?>
		<div class="sidebarRight">
			<div class="sidebarRightTitle">
				<a href="/blog/archive/">
                    <?= getMessage('GL_BLOG_ARCHIVE') ?>
                </a>
			</div>
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
                
                <div id="js-blog-archive-nav-id" class="cabinet-pagination hidden-xs">
                    <?= $arResult['NAV_STRING'] ?>
                </div>
			</div>
		</div>
	<? } ?>
</div>