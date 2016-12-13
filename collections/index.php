<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Art Agency"); ?>

<? IncludeFileLangFile(__FILE__) ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain">
    <div class="container">
        <div class="collections-triggers bg-transparent"> 
            <a href="/collections/map/"><?= getMessage('GL_COLLECTIONS_MAP') ?></a>
            <a href="/collections/" class="active"><?= getMessage('GL_COLLECTIONS_ALL') ?></a>
        </div>
        
        <div class="row">
            <? // Коллекции.
                $APPLICATION->IncludeComponent(
                    "glyf:picture.filter",
                    "sideleft",
                    array()
                );
            ?>
            
            <?	// Коллекции.
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "collections",
                    array(
                        "CURRENT" => strval($_REQUEST['SECTION']),
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "N",
                        "IBLOCK_TYPE" => "products",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => strval($_REQUEST['SECTION']),
                        "SECTION_URL" => "",
                        "COUNT_ELEMENTS" => "Y",
                        "TOP_DEPTH" => "2",
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
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>