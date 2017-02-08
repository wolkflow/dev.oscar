<? define('NEED_AUTH', 'Y') ?>
<? define('PAGE', 'UPLOAD') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Oscar Collection"); ?>

<?  // Проверка пользователя.
    $user = new Glyf\Oscar\User();
    if (!$user->isPartner()) {
        LocalRedirect('/personal/');
    }
?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain bg-gray">
	<?	// Загрузка изображения.					
		$APPLICATION->IncludeComponent(
			"glyf:picture.upload",
			"picture",
			array()
		);
	?>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>