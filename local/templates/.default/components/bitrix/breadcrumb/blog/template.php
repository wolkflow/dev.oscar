<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?

if (empty($arResult)) {
	return '';
}

$strReturn = '<ol class="breadcrumb">';

// Удаление главной страницы.
array_shift($arResult);

//$arLast = array_pop($arResult);
//$arLast['LINK'] = '';
//array_push($arResult, $arLast);

for ($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]['TITLE']);
	if ($arResult[$index]['LINK'] <> '') {
		$strReturn .= '<li><a href="'.$arResult[$index]['LINK'].'" title="'.$title.'">'.$title.'</a></li> ';
	} else {
		$strReturn .= '<li>'.$title.'</li> ';
	}
}

$strReturn .= '</ol>';

return $strReturn;

?>