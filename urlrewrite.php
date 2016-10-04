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
);

?>