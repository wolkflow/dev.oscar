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

<main class="siteMain page-cabinet">
    <? $user = new Glyf\Oscar\User() ?>
    
    <? if ($user->isPartner()) { ?>
        <div class="cabinet-menu">
            <a class="is-active" href="/personal/">общие сведения пользователя</a>
            <a href="/personal/folders/">каталог</a>
        </div>
    <? } ?>
    
    <div class="container">
        <div class="row cabinet-stats">
            <div class="col-md-9 col-sm-9">
                <ol class="breadcrumb">
                    <li><a href="/personal/">Личный кабинет</a></li>
                </ol>
            </div>
            <?	// Профиль.					
                $APPLICATION->IncludeComponent(
                    "glyf:user.profile",
                    "profile",
                    array()
                );
            ?>
            <div class="col-md-9 col-sm-9">
                <div class="cabinet-content">
                    <? if ($user->isPartner()) { ?>
                        
                        <?	// Статистика.					
                            $APPLICATION->IncludeComponent(
                                "glyf:statistic.common",
                                "profile",
                                array()
                            );
                        ?>
                        
                        <?	// Статистика продаж.					
                            $APPLICATION->IncludeComponent(
                                "glyf:statistic.sales",
                                "profile",
                                array()
                            );
                        ?>
                        
                        <?	// Статистика продаж по объектам.					
                            $APPLICATION->IncludeComponent(
                                "glyf:statistic.sales.objects",
                                "profile",
                                array()
                            );
                        ?>
                        
                    <? } else { ?>
                    
                        <?	// Сборники.					
                            $APPLICATION->IncludeComponent(
                                "glyf:lightbox.list",
                                "profile",
                                array()
                            );
                        ?>
                    
                        <?	// Заказы.					
                            $APPLICATION->IncludeComponent(
                                "glyf:user.orders",
                                "profile",
                                array("PERPAGE" => 1)
                            );
                        ?>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>