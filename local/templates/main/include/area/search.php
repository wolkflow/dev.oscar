<? use Bitrix\Main\Localization\Loc; ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<? // Фильтр.
    $APPLICATION->IncludeComponent(
        "glyf:picture.filter",
        "popup",
        array()
    );
?>