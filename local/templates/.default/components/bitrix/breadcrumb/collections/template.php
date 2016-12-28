<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult)) {
	return '';
}

$result = '<ol class="breadcrumb">';

// Удаление главной страницы.
array_shift($arResult);

//$arLast = array_pop($arResult);
//$arLast['LINK'] = '';
//array_push($arResult, $arLast);



$lastitem = array_pop($arResult);
foreach ($arResult as $item) {
    $title   = htmlspecialcharsex($item['TITLE']);
    $result .= '<li><a href="'.$item['LINK'].'" title="'.$title.'">'.$title.'</a></li> ';
}

$title   = htmlspecialcharsex($lastitem['TITLE']);
$result .= '<li class="last"><a href="'.$lastitem['LINK'].'" title="'.$title.'">'.$title.'</a></li> ';

$result .= '</ol>';

return $result;
