<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="pdf">
    <div class="pdfTop">
        <div class="pdfTitle">Статистика продаж</div>
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
        <div class="pdfTable pdfTableStats">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>название</th>
                        <th>просмотров</th>
                        <th>продаж</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($arResult['ITEMS'] as $item) { ?>
                        <tr>
                            <td>
                                <span>№</span> <?= $item->getID() ?>
                            </td>
                            <td>
                                <?= $item->getTitle() ?>
                            </td>
                            <td>
                                <?= $item->getStatViews() ?>
                            </td>
                            <td>
                                <?= $item->getStatSales() ?>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
