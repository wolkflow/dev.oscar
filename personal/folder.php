<? define('NEED_AUTH', 'Y') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Персональная статистика"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>
<?  // Данные отображения.

    // Запрос.
    $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    
    $order = $request->get('order');
    $count = $request->get('count');
    $page  = $request->get('page');

?>
<main class="siteMain page-cabinet">
    <div class="container">
        <div class="row">
            <?	// Статистика по папке.					
                $APPLICATION->IncludeComponent(
                    "glyf:statistic.folder",
                    "profile",
                    array(
                        "FID"     => intval($_REQUEST['ELEMENT']),
                        //"PAGE"    => $page,
                       // "PERPAGE" => $count                            
                    )
                );
            ?>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>