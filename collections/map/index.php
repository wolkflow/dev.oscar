<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Collection"); ?>

<? IncludeFileLangFile(__FILE__) ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
	<div class="collections-triggers">
		<a href="/collections/map/" class="active"><?= getMessage('GL_COLLECTIONS_MAP') ?></a>
		<a href="/collections/"><?= getMessage('GL_COLLECTIONS_ALL') ?></a>
	</div>
	
	<?	// Коллекции.
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"collections-map",
			array(
				"VIEW_MODE" => "TEXT",
				"SHOW_PARENT_NAME" => "N",
				"IBLOCK_TYPE" => "products",
				"IBLOCK_ID" => "4",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"SECTION_URL" => "",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => "4",
				"SECTION_FIELDS" => "",
				"SECTION_USER_FIELDS" => array("UF_LANG_TITLE_RU", "UF_LANG_TITLE_EN"),
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_NOTES" => "",
				"CACHE_GROUPS" => "Y"
			)		
		);
	?>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>