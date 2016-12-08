<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? $cols = 5 ?>

<div class="pdf">
    <div class="pdfTop">
        <div class="pdfTitle">
            <? if (!empty($arResult['FOLDERS'])) { ?>
                Папки
            <? } elseif (!empty($arResult['LIGHTBOXES'])) { ?>
                Сборники
            <? } else { ?>
                Изображения
            <? }?>
        </div>
        <div class="pdfLogo">
            <div class="pdfLogoImage">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo.png" />
            </div>
            <div class="pdfLogoText">
                oscarartagency.ru <br> 
                +7 (916) 301 34 50 <br>
                office@OscarArtAgency.ru
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <? if (!empty($arResult['PICTURES'])) { ?>
        <div class="pdfBody">
            <div class="pdfGrid">
                <? $chunks = array_chunk($arResult['PICTURES'], $cols, true) ?>
                
                <? foreach ($chunks as $pictures) { ?>
                    <div class="pdfRow">
                        <? foreach ($pictures as $picture) { ?>
                            <div class="pdfCol">
                                <div class="pdfColImage">
                                    <img src="/i.php?src=<?= $picture->getSmallPreviewImageSrc() ?>&w=95&h=95" />
                                </div>
                                <div class="pdfColTitle">
                                    <?= $picture->getTitle() ?>
                                </div>
                                <div class="pdfColAuthor">
                                    <?= $picture->getAuthor()->getName() ?>
                                </div>
                                <? /*
                                <div class="pdfColText">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</div>
                                */ ?>
                            </div>
                        <? } ?>
                        <div class="clearfix"></div>
                    </div>
                <? } ?>
            </div>
        </div>
    <? } ?>
    
    <? if (!empty($arResult['FOLDERS'])) { ?>
        <div class="pdfBody">
            <? foreach ($arResult['FOLDERS'] as $folder) { ?>
                <div class="pdfRowTitle">
                    <?= $folder['TITLE'] ?>
                </div>
                <div class="pdfGrid">
                    <? $chunks = array_chunk($folder['ITEMS'], $cols, true) ?>
                    <? foreach ($chunks as $pictures) { ?>
                        <div class="pdfRow">
                            
                            <? foreach ($pictures as $picture) { ?>
                                <div class="pdfCol">
                                    <div class="pdfColImage">
                                        <img src="/i.php?src=<?= $picture->getSmallPreviewImageSrc() ?>&w=95&h=95" />
                                    </div>
                                    <div class="pdfColTitle">
                                        <?= $picture->getTitle() ?>
                                    </div>
                                    <div class="pdfColAuthor">
                                        <?= $picture->getAuthor()->getName() ?>
                                    </div>
                                </div>
                            <? } ?>
                            <div class="clearfix"></div>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    <? } ?>
    
    <? if (!empty($arResult['LIGHTBOXES'])) { ?>
        <div class="pdfBody">
            <? foreach ($arResult['LIGHTBOXES'] as $lightbox) { ?>
                <div class="pdfRowTitle">
                    <?= $lightbox['TITLE'] ?>
                </div>
                <div class="pdfGrid">
                    <? $chunks = array_chunk($lightbox['ITEMS'], $cols, true) ?>
                    <? foreach ($chunks as $pictures) { ?>
                        <div class="pdfRow">
                            
                            <? foreach ($pictures as $picture) { ?>
                                <div class="pdfCol">
                                    <div class="pdfColImage">
                                        <img src="/i.php?src=<?= $picture->getSmallPreviewImageSrc() ?>&w=95&h=95" />
                                    </div>
                                    <div class="pdfColTitle">
                                        <?= $picture->getTitle() ?>
                                    </div>
                                    <div class="pdfColAuthor">
                                        <?= $picture->getAuthor()->getName() ?>
                                    </div>
                                </div>
                            <? } ?>
                            <div class="clearfix"></div>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    <? } ?>
    
</div>