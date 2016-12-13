<? use Bitrix\Main\Localization\Loc; ?>
<? IncludeAreaLangFile(__FILE__); ?>
<? use Glyf\Core\Helpers\Text as TextHelper; ?>
<?
	if (\Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule('glyf.core')) {
		$result = CIBlockElement::getList(array(), array('IBLOCK_ID' => IBLOCK_PARTNERS_ID, 'ACTIVE' => 'Y'), false, false, array('ID'));
		$count  = (int) $result->SelectedRowsCount();
	}
?>

<?= $count ?> 
<?= TextHelper::decofnum($count, array(getMessage('GL_MUSEUMS_1N'), getMessage('GL_MUSEUMS_2N'), getMessage('GL_MUSEUMS_3N'))) ?> 
<?= getMessage('GL_TRUST_US') ?>