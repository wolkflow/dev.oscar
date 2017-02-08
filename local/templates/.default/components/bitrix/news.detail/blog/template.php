<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? /*
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<?	// Цепочка навигации.
					$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"blog",
						array(
							"START_FROM" => "0", 
							"PATH" => "", 
							"SITE_ID" => "s1" 
						),
                        $component
					);
				?>
			</div>
		</div>
	</div>
*/ ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<article class="article text">
					<div class="articleImage">
						<img src="/i.php?src=<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>&w=752&h=383" />
					</div>
					<h1><?= $arResult['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?></h1>
					<div class="articleAnnotation">
						<?= $arResult['PROPERTIES']['LANG_SUBTITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
					</div>
					<p>
						<?= $arResult['PROPERTIES']['LANG_DETAIL_TEXT_'.CURRENT_LANG_UP]['~VALUE']['TEXT'] ?>
					</p>
					<? if (!empty($arResult['PROPERTIES']['LANG_TAGS_'.CURRENT_LANG_UP]['VALUE'])) { ?>
						<div class="articleKeywords">
							<p>
								<?= getMessage('GL_KEYWORDS') ?>
							</p>
							<p>
								<? $tags = array() ?>
								<? foreach ($arResult['PROPERTIES']['LANG_TAGS_'.CURRENT_LANG_UP]['VALUE'] as $tag) { ?>
									<? $tags []= '<a href="/blog/search/?TAG=' . $tag . '">' . $tag . '</a>' ?>
								<? } ?>
								<?= implode(', ', $tags) ?>
							</p>
						</div>
					<? } ?>
				</article>
			</div>
		</div>
	</div>
<? /* </div>
*/ ?>
<? if (!empty($arResult['PROPERTIES']['SIMILARS']['VALUE'])) { ?>
	<div class="similarItems hidden-xs">
		<div class="container">
			<h5>
				<?= getMessage('GL_BLOG_OTHER_ARTICLES') ?>
			</h5>
			<?	// Похожие статьи блога.
				$GLOBALS['arrBlogSimilarsFilter'] = array('ID' => $arResult['PROPERTIES']['SIMILARS']['VALUE']);
				
				$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"blog-similars",
					array(
						"IBLOCK_TYPE" => "content",
						"IBLOCK_ID" => "3",
						"NEWS_COUNT" => "12",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "DESC",
						"FILTER_NAME" => "arrBlogSimilarsFilter",
						"FIELD_CODE" => array(),
						"PROPERTY_CODE" => array("*"),
						"PARENT_SECTION_CODE" => $arParams['SECTION'],
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "86400",
						"CACHE_FILTER" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "0",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"DISPLAY_PANEL" => "N",
						"SET_TITLE" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"DISPLAY_TOP_PAGER"	=> "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "N",
						"DISPLAY_PREVIEW_TEXT" => "Y"
					)
				);
			?>
		</div>
	</div>
<? } ?>