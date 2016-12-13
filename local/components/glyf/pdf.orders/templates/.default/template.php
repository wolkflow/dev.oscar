<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Statistic\Sale; ?>
<? use Glyf\Oscar\License; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>


<div class="pdf">
    <div class="pdfTop">
        <div class="pdfTitle"><?= getMessage('GL_SALES_STATISTICS') ?></div>
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
    
    <div class="pdfBody">
        <div class="pdfTable">
            <table>
                <tbody>
                    <? foreach ($arResult['ITEMS'] as $item) { ?>
                        <tr>
                            <td>
                                <img style="max-height: 35px; max-width: 35px;" src="<?= CFile::getPath($item['PICTURE'][Picture::FIELD_SMALL_FILE]) ?>" />
                            </td>
                            <td>
                                <span>№</span> <?= $item[Sale::FIELD_ORDER_ID] ?>
                            </td>
                            <td>
                                <?= $item['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                            </td>
                            <td>
                                <span><?= getMessage('GL_LICENSE') ?></span> 
                                <?= $item['LICENSE'][License::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                            </td>
                            <td>
                                <span><?= getMessage('GL_DATE') ?></span>
                                <?= date('d.m.Y', strtotime($item[Sale::FIELD_TIME])) ?>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>