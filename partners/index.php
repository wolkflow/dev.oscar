<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Главная страница"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
	
	<div class="partnersTop">
		<div class="container">
			<article class="text">
				<div class="row">
					<?	// Сотрудничество.					
						$APPLICATION->IncludeComponent(
							"bitrix:news.detail",
							"columns",
							array(
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"USE_SHARE" => "Y",
								"SHARE_HIDE" => "N",
								"SHARE_TEMPLATE" => "",
								"SHARE_HANDLERS" => array(),
								"SHARE_SHORTEN_URL_LOGIN" => "",
								"SHARE_SHORTEN_URL_KEY" => "",
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "content",
								"IBLOCK_ID" => "2",
								"ELEMENT_ID" => "",
								"ELEMENT_CODE" => "partnership",
								"CHECK_DATES" => "N",
								"FIELD_CODE" => array(),
								"PROPERTY_CODE" => array("*"),
								"IBLOCK_URL" => "",
								"SET_TITLE" => "Y",
								"SET_BROWSER_TITLE" => "Y",
								"BROWSER_TITLE" => "-",
								"SET_META_KEYWORDS" => "Y",
								"META_KEYWORDS" => "-",
								"SET_META_DESCRIPTION" => "Y",
								"META_DESCRIPTION" => "-",
								"SET_STATUS_404" => "Y",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"ADD_ELEMENT_CHAIN" => "N",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"USE_PERMISSIONS" => "N",
								"GROUP_PERMISSIONS" => array('1', '2'),
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_GROUPS" => "Y",
								"DISPLAY_TOP_PAGER" => "Y",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_TEMPLATE" => "",
								"PAGER_SHOW_ALL" => "Y",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N"
							)
						);
					?>
					
					<?	// Документы.
						$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"documents",
							array(
								"IBLOCK_TYPE" => "content",
								"IBLOCK_ID" => "7",
								"NEWS_COUNT" => "6",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "",
								"FIELD_CODE" => array(),
								"PROPERTY_CODE" => array("*"),
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
				<div class="partnersCount">
					<?  // Количество партнеров.
						$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_TEMPLATE_PATH.'/include/area/partners.partners-count.php',
							'EDIT_TEMPLATE' => 'html'
						));
					?>
				</div>
			</article>
		</div>
	</div>
	
	<?	// Партнеры.
		$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"partners",
			array(
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => "6",
				"NEWS_COUNT" => "12",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(),
				"PROPERTY_CODE" => array("*"),
				"CACHE_TYPE" => "N",
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
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "common-light",
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
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>