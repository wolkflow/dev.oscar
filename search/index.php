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
        <ol class="breadcrumb">
            <li><a href="/collections/">Коллекции</a></li>
            <li>Поиск</li>
        </ol>
    
        <div class="row">
            <? // Фильтр.
                $APPLICATION->IncludeComponent(
                    "glyf:picture.filter",
                    "sideleft",
                    array()
                );
            ?>
            
            <?	// Результаты поиска.
                $APPLICATION->IncludeComponent(
                    "glyf:picture.search",
                    "pictures",
                    array()		
                );
            ?>
            
            <?  // Сборники.
                $APPLICATION->IncludeComponent(
                    "glyf:lightbox.list",
                    "side",
                    array()
                );
            ?>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>