<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? \Bitrix\Main\Loader::includeModule('glyf.core') ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<?

if (!$arResult['NavShowAlways']) {
	if ($arResult['NavRecordCount'] == 0 || ($arResult['NavPageCount'] == 1 && $arResult['NavShowAll'] == false)) {
		return;
	}
}

$strNavQueryString     = ($arResult['NavQueryString'] != "" ? $arResult['NavQueryString']."&amp;" : "");
$strNavQueryStringFull = ($arResult['NavQueryString'] != "" ? "?".$arResult['NavQueryString'] : "");

$prev = ($arResult['NavPageNomer'] > 1) ? ($arResult['NavPageNomer'] - 1) : ($arResult['NavPageNomer']);
$next = ($arResult['NavPageNomer'] < $arResult['nEndPage']) ? ($arResult['NavPageNomer'] + 1) : ($arResult['nEndPage']);

?>

<div class="cabinet-pagination white-pagination hidden-xs">
	<div class="cabinet-pagination__count"><span class="current">
		<?= $arResult['NavPageNomer'] ?></span> 
		<?= getMessage('GL_FROM') ?>
		<?= $arResult['nEndPage'] ?>
	</div>
	<div class="cabinet-pagination__buttons">
		<a href="<?= $arResult['sUrlPath'] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult['NavNum'] ?>=<?= $prev ?>" class="cabinet-pagination__button cabinet-pagination__button--prev">&lsaquo;</a>
		<a href="<?= $arResult['sUrlPath'] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult['NavNum'] ?>=<?= $next ?>" class="cabinet-pagination__button cabinet-pagination__button--next is-active">&rsaquo;</a>
	</div>
</div>
