<?php

/*
 * Время.
 */
define('TIME_HOUR',  3600);
define('TIME_DAY',   86400);
define('TIME_WEEK',  604800);
define('TIME_MONTH', 2592000);
define('TIME_YEAR',  31536000);

define('TIME_MONTH_IN_QUARTER', 3);

define ('TIME_YEARS_IN_DECADE',    10);
define ('TIME_YEARS_IN_CENTURY',   100);
define ('TIME_YEARS_IN_MILLENIUM', 1000);

/*
 * Размер (байт)
 */
define('BYTES_IN_KILOBYTE', 1024);
define('BYTES_IN_MEGABYTE', 1048576);
define('BYTES_IN_GIGABYTE', 1073741824);
 
 
/*
 * Сайт.
 */
define('SITE_DEFAULT', 's1');

define('SITE_RU', 's1');
define('SITE_EN', 's2');


/*
 * Языки.
 */
define('LANG_RU', 'ru');
define('LANG_EN', 'en');


/*
 * Поддомены.
 */
define('SUBDOMAIN_IMAGES', 'img.oscar.dev.wolkflow.com');


/*
 * Шаблоны.
 */
define('MAIN_TEMPLATE_PATH', '/local/templates/main');


/*
 * Инфоблоки.
 */
define('IBLOCK_CONTENT_ID',     2);
define('IBLOCK_BLOG_ID',        3);
define('IBLOCK_COLLECTIONS_ID', 4);
define('IBLOCK_TARIFFS_ID',     5);
define('IBLOCK_PARTNERS_ID',    6);
define('IBLOCK_DOCUMENTS_ID',   7);


/*
 * HL-блоки.
 */
define('HLBLOCK_STATISTIC_VIEW_ID',     1);
define('HLBLOCK_STATISTIC_DOWNLOAD_ID', 2);
define('HLBLOCK_SUBSCRIBES_ID',         3);
define('HLBLOCK_PICTURES_ID',           4);
define('HLBLOCK_DICT_AUTHORS_ID',       5);
define('HLBLOCK_DICT_HOLDERS_ID',       6);
define('HLBLOCK_SEARCHES_ID',           7);
define('HLBLOCK_DICT_FOLDERS_ID',       8);
define('HLBLOCK_DICT_KEYWORDS_ID',      9);
define('HLBLOCK_DICT_TECHNIQUES_ID',    10);
define('HLBLOCK_LIGHTBOXES_ID',         13);
define('HLBLOCK_LIGHTBOXE_PICTURES_ID', 14);
define('HLBLOCK_STATISTIC_SALES_ID',    15);
define('HLBLOCK_IPADDRESSES_ID',        16);
define('HLBLOCK_LICENSES_ID',           17);

// Месторасположение.
define('HLBLOCK_DICT_PLACE_COUNTRIES_ID', 11);
define('HLBLOCK_DICT_PLACE_CITIES_ID',    12);


/*
 * Группы.
 */
define('GROUP_PARTNERS_ID', 8);
 

/*
 * JWT ключ
 */
define('JWT_KEY', 'OscarArtAgency');


/*
 * Модули.
 */
define('MODULE_GLYF_CORE_ID', 'glyf.core');
define('MODULE_GLYF_OSCAR_ID', 'glyf.oscar');


/*
 * Валюта.
 */
define('CURRENCY_DEFAULT', 'RUB');
 

/*
 * Тип плательщика.
 */
define('PERSON_TYPE_DEFAULT', 1);


/*
 * Платежная система.
 */
define('PAYSYSTEM_DEFAULT',   2);

define('PAYSYSTEM_ACCOUNT',   1);
define('PAYSYSTEM_ROBOKASSA', 2);


/*
 * Служба доставки.
 */
define('DELYVERY_SYSTEM_DEFAULT', 2);

/*
 * Тип цен.
 */
define('PRICE_TYPE_DEFAULT', 1);


/*
 * Статус заказа.
 */
define('STATUS_DEFAULT', 'N');

