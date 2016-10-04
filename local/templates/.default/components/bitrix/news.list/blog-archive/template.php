<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?	// Цепочка навигации.
				$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"blog",
					array(
						"START_FROM" => "0", 
						"PATH" => "", 
						"SITE_ID" => "s1" 
					)
				);
			?>
		</div>
	</div>
</div>

<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="container archiveList">
		<div class="row">
			<? foreach ($arResult['ITEMS'] as $item) { ?>
				<div class="col-sm-6 col-md-4">
					<article class="archiveArticle text">
						<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
							<div class="archiveArticleImage">
								<img src="/i.php?src=<?= $item['PREVIEW_PICTURE']['SRC'] ?>&w=340&h=97" />
								<div class="catmark"><?= $item['SECTION_LANG_TITLE'] ?></div>
							</div>
							<p>
								<?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
							</p>
						</a>
					</article>
				</div>
			<? } ?>
		</div>
	</div>
<? } ?>