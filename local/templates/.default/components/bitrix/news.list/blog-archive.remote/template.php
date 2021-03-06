<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="col-sm-4 col-md-4 hidden-xs">
		<div class="sidebarRight">
			<div class="sidebarRightTitle">
				<?= getMessage('GL_BLOG_ARCHIVE') ?>
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
				<?= $arResult['NAV_STRING'] ?>
			</div>
		</div>
	</div>
<? } ?>