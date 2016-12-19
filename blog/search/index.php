<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Art Agency"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8">
					<?	// Разделы блога.
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"blog",
							array(
								"SECTION" => strval($_REQUEST['SECTION']),
								"VIEW_MODE" => "TEXT",
								"SHOW_PARENT_NAME" => "N",
								"IBLOCK_TYPE" => "content",
								"IBLOCK_ID" => "3",
								"SECTION_ID" => "",
								"SECTION_CODE" => "",
								"SECTION_URL" => "",
								"COUNT_ELEMENTS" => "Y",
								"TOP_DEPTH" => "1",
								"SECTION_FIELDS" => "",
								"SECTION_USER_FIELDS" => array("UF_LANG_TITLE_RU", "UF_LANG_TITLE_EN"),
								"ADD_SECTIONS_CHAIN" => "Y",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_NOTES" => "",
								"CACHE_GROUPS" => "Y"
							)		
						);
					?>
					
					<?	// Статьи блога (текущие).
                        $tag = trim((string) $_REQUEST['TAG']);
                        
                        if (!empty($tag)) {
                            $GLOBALS['arBlogSearchFilter'] = array(array(
                                'LOGIC' => 'OR',
                                array('PROPERTY_LANG_TAGS_RU' => '%' . $tag . '%'),
                                array('PROPERTY_LANG_TAGS_EN' => '%' . $tag . '%'),
                            ));
                        }
                        
						$ids = $APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"blog",
							array(
								"IBLOCK_TYPE" => "content",
								"IBLOCK_ID" => "3",
								"NEWS_COUNT" => "6",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arBlogSearchFilter",
								"FIELD_CODE" => array(),
								"PROPERTY_CODE" => array("*"),
								"PARENT_SECTION_CODE" => "",
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
				
                <div id="js-blog-archive-wrapper-id">
                    <?	// Статьи блога (архив).
                        $GLOBALS['arBlogArchiveFilter'] = array('!ID' => $ids);
                    
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "blog-archive-small",
                            array(
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => "3",
                                "NEWS_COUNT" => "14",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ID",
                                "SORT_ORDER2" => "DESC",
                                "FILTER_NAME" => "arBlogArchiveFilter",
                                "FIELD_CODE" => array(),
                                "PROPERTY_CODE" => array("*"),
                                "PARENT_SECTION_CODE" => strval($_REQUEST['SECTION']),
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
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "PAGER_TITLE" => "",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "remote-dark",
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
		</div>
	</div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>