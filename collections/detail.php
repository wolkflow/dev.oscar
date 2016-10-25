<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Карта коллекций"); ?>

<? IncludeFileLangFile(__FILE__) ?>

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
            <div class="row flex">
                
                <?  // Картина.
                    $APPLICATION->IncludeComponent(
                        "glyf:picture.detail",
                        "picture",
                        array("PID" => intval($_REQUEST['ELEMENT']))
                    );
                ?>
                
                <div class="col-md-3 col-sm-3 hidden-xs">
                    <div class="sidebarRight">
                        <div class="sidebarRightTitle">Лайтбоксы</div>
                        <div class="lightboxes">
                            <div class="lightboxes__item">
                                <div class="lightboxes__item-title is-expanded">Список №1</div>
                                <div class="lightboxes__item-content">
                                    <div class="lightboxes__item-pictures">
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lightboxes__item-bottom">
                                        <div class="row">
                                            <div class="col-sm-6 lightboxes__item-bottom-count">25</div>
                                            <div class="col-sm-6 lightboxes__item-bottom-link">
                                                <a href="#">ПЕРЕЙТИ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lightboxes__item">
                                <div class="lightboxes__item-title">Список №2</div>
                                <div class="lightboxes__item-content">
                                    <div class="lightboxes__item-pictures">
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lightboxes__item-bottom">
                                        <div class="row">
                                            <div class="col-sm-6 lightboxes__item-bottom-count">25</div>
                                            <div class="col-sm-6 lightboxes__item-bottom-link">
                                                <a href="#">ПЕРЕЙТИ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lightboxes__item">
                                <div class="lightboxes__item-title">Список №3</div>
                                <div class="lightboxes__item-content">
                                    <div class="lightboxes__item-pictures">
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="lightboxes__item-pictures-row">
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                            <div class="lightboxes__item-pictures-col">
                                                <a href="#">
                                                    <img src="images/horse.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lightboxes__item-bottom">
                                        <div class="row">
                                            <div class="col-sm-6 lightboxes__item-bottom-count">25</div>
                                            <div class="col-sm-6 lightboxes__item-bottom-link">
                                                <a href="#">ПЕРЕЙТИ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lightboxes__item">
                                <div class="lightboxes__item-title is-expanded lightboxes__item-title--new">Создать новый</div>
                                <div class="lightboxes__item-content">
                                    <span class="lightboxes__item-new">Перетащите изображения сюда, чтобы добавить в лайтбокс</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>