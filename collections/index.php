<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Collection"); ?>

<? $section = strval($_REQUEST['SECTION']) ?>

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
        <?  // Цепочка навигации.
            if (!empty($section)) {
                $APPLICATION->AddChainItem(getMessage('GL_COLLECTIONS_ALL'), '/collections/');
                
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "collections",
                    array(
                        "START_FROM" => "0", 
                        "PATH" => "", 
                        "SITE_ID" => "s1" 
                    )
                );
            }
        ?>
        
        <? if (empty($section)) { ?>
            <div class="collections-triggers bg-transparent"> 
                <a href="/collections/map/"><?= getMessage('GL_COLLECTIONS_MAP') ?></a>
                <a href="/collections/" class="active"><?= getMessage('GL_COLLECTIONS_ALL') ?></a>
            </div>
        <? } ?>
        
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
                        "CURRENT" => $section,
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "N",
                        "IBLOCK_TYPE" => "products",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => $section,
                        "SECTION_URL" => "",
                        "COUNT_ELEMENTS" => "Y",
                        "TOP_DEPTH" => "1",
                        "SECTION_FIELDS" => "",
                        "SECTION_USER_FIELDS" => array("UF_LANG_TITLE_RU", "UF_LANG_TITLE_EN"),
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "600",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y"
                    )		
                );
            ?>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>