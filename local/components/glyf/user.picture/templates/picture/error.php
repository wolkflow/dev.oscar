<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ERROR'])) { ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div style="min-height: 160px; padding-top: 40px;">
                <h3><?= $arResult['ERROR'] ?></h3>
            </div>
        </div>
    </div>
<? } ?>