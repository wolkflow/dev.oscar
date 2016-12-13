<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? use Glyf\Oscar\Collection; ?>

<?  // Столбцы.
    $columns = array(
        array(3, 5, 4),
        array(4, 3, 5),
        array(5, 4, 3),
    );
?>

<? if (!empty($arResult['SECTIONS'])) { ?>
	<div class="col-sm-9 col-lg-10">
        <div class="row">
            <? $irow = 0; $icol = 0; ?>
			<? foreach ($arResult['SECTIONS'] as $section) { ?>
                <? $collection = new Collection($section['ID']) ?>
                <? $cols = $columns[$irow][$icol]; ?>
                <div class="col-sm-4 col-lg-<?= $cols ?> catalogItem">
                    <a href="<?= $section['SECTION_PAGE_URL'] ?>">
                        <div class="catalogItemImage" style="background-image: url(<?= $section['PICTURE']['SRC'] ?>)"></div>
                        <div class="catalogItemTitle">
                            <?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                        </div>
                        <div class="catmark">
                            <?= number_format($collection->getPicturesCount(), 0, '.', ' ') ?>
                        </div>
                    </a>
                </div>
                <?  // Сдвиг изображений. 
                    $icol++;
                    if ($icol % 3 == 0) { 
                        $irow++; 
                        $icol = 0;
                    }
                    if ($irow % 3 == 0) {
                        $irow = 0;
                    }
                ?>
			<? } ?>
		</div>
	</div>
<? } else { ?>
    <?	// Картины.
        $APPLICATION->IncludeComponent(
            "glyf:picture.list",
            "pictures",
            array(
                "COLLECTION" => $arResult['SECTION']['ID']
            )
        );
    ?>
    
    <?  // Сборники.
        $APPLICATION->IncludeComponent(
            "glyf:lightbox.list",
            "side",
            array(),
            $component
        );
    ?>
<? } ?>