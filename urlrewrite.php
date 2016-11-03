<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/blog/(.+?)/(.+?)/#",
		"RULE" => "SECTION=\$1&ELEMENT=\$2&",
		"ID" => "",
		"PATH" => "/blog/detail.php",
	),
	array(
		"CONDITION" => "#^/blog/(.+?)/#",
		"RULE" => "SECTION=\$1&",
		"ID" => "",
		"PATH" => "/blog/index.php",
	),
    
    array(
		"CONDITION" => "#^/personal/card/(.+?)/#",
		"RULE" => "SECTION=\$1&",
		"ID" => "",
		"PATH" => "/personal/card.php",
	),
    
    array(
		"CONDITION" => "#^/collections/([\d]+)/#",
		"RULE" => "ELEMENT=\$1&",
		"ID" => "",
		"PATH" => "/collections/detail.php",
	),
    array(
		"CONDITION" => "#^/collections/(.+?)/(.+?)/(.+?)/#",
		"RULE" => "SECTION=\$1&PATH[]=\$1&PATH[]=\$2&PATH[]=\$3&",
		"ID" => "",
		"PATH" => "/collections/index.php",
	),
    array(
		"CONDITION" => "#^/collections/(.+?)/(.+?)/#",
		"RULE" => "SECTION=\$1&PATH[]=\$1&PATH[]=\$2&",
		"ID" => "",
		"PATH" => "/collections/index.php",
	),
    array(
		"CONDITION" => "#^/collections/(.+?)/#",
		"RULE" => "SECTION=\$1&PATH[]=\$1&",
		"ID" => "",
		"PATH" => "/collections/index.php",
	),
);

?>