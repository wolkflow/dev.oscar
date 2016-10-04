<?php

if (Bitrix\Main\Loader::includeModule('iblock')) {
	return;
}

$ids = array();

$result = CIBlockElement::GetList(
	array('SORT' => 'ASC', 'ID' => 'DESC'), 
	array('IBLOCK_ID' => IBLOCK_BLOG_ID, 'ACTIVE' => 'Y'), 
	false, 
	false,
	array('ID')
);

while ($item = $result->fetch()) {
	$ids []= (int) $item['ID'];
}
unset($item, $result);


$GLOBALS['arBlogArchiveFilter'] = array('!ID' => $ids);
				
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"blog-archive.remote",
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "3",
		"NEWS_COUNT" => "12",
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
		"PAGER_TEMPLATE" => "common-dark",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y"
	)
);