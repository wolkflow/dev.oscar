<?php

define('NO_KEEP_STATISTIC', true);
define('PULL_AJAX_INIT', true);
define('PUBLIC_AJAX_MODE', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('DisableEventsCheck', true);

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

// Директория для ajax-скриптов.
define ('DIR_REMOTE', $_SERVER['DOCUMENT_ROOT'] . '/remote/include/');

/**
 * Ответ в формате JSON.
 */
function jsonresponse($status, $message = '', $data = null, $console = '', $type = 'json')
{
	$result = array(
		'status'  => (bool)   $status,
		'message' => (string) $message,
		'data' 	  => (array)  $data,
		'console' => (string) $console,
	);
	
	header('Content-Type: application/json');
	echo json_encode($result);
	exit();
}

/** 
 * Получение HTML.
 */
function gethtmlremote($file)
{
	ob_start();
	include (DIR_REMOTE . $file);
	return ob_get_clean();
}


Bitrix\Main\Loader::includeModule('glyf.core');
Bitrix\Main\Loader::includeModule('glyf.oscar');
Bitrix\Main\Loader::includeModule('catalog');
Bitrix\Main\Loader::includeModule('sale');


global $USER;

// Запрос.
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

// Действие.
$action = (string) $request->get('action');



// Обработка действий.
switch ($action) {
	
	// Вывод статей блога.	
	case ('blog-archive-page'):
		$html = gethtmlremote('blog.archive.php');
		jsonresponse(true, '', $html, '', 'html');
		break;
    
    
    // Подсказка для автора.
    case ('dictionary-author-suggest'):
        $text = (string) $request->get('text');
        
        $result = Glyf\Oscar\Dictionaries\Author::getList(array(
            'filter' => array('UF_LANG_NAME_' . CURRENT_LANG_UP => '%'.$text.'%'),
            'select' => array('ID', 'UF_LANG_NAME_' . CURRENT_LANG_UP),
            'limit'  => 10,
        ), false);
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= array('id' => $item['ID'], 'value' => $item['UF_LANG_NAME_' . CURRENT_LANG_UP]);
        }
        jsonresponse(true, '', $items);
        break;
    
    
    // Подсказка для правообладателя.
    case ('dictionary-holder-suggest'):
        $text = (string) $request->get('text');
        
        $result = Glyf\Oscar\Dictionaries\Holder::getList(array(
            'filter' => array('UF_LANG_NAME_' . CURRENT_LANG_UP => '%'.$text.'%'),
            'select' => array('ID', 'UF_LANG_NAME_' . CURRENT_LANG_UP),
            'limit'  => 10,
        ), false);
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= array('id' => $item['ID'], 'value' => $item['UF_LANG_NAME_' . CURRENT_LANG_UP]);
        }
        jsonresponse(true, '', $items);
        break;
        
    
    // Подсказка для техники.
    case ('dictionary-technique-suggest'):
        $text = (string) $request->get('text');
        
        $result = Glyf\Oscar\Dictionaries\Technique::getList(array(
            'filter' => array('UF_LANG_NAME_' . CURRENT_LANG_UP => '%'.$text.'%'),
            'select' => array('ID', 'UF_LANG_NAME_' . CURRENT_LANG_UP),
            'limit'  => 10,
        ), false);
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= array('id' => $item['ID'], 'value' => $item['UF_LANG_NAME_' . CURRENT_LANG_UP]);
        }
        jsonresponse(true, '', $items);
        break;
    
    
    // Подсказка для страны.
    case ('dictionary-place-country-suggest'):
        $text = (string) $request->get('text');
        
        $result = Glyf\Oscar\Dictionaries\PlaceCountry::getList(array(
            'order'  => array('UF_SORT' => 'ASC', 'UF_LANG_NAME_' . CURRENT_LANG_UP => 'ASC'),
            'filter' => array('UF_LANG_NAME_' . CURRENT_LANG_UP => '%'.$text.'%'),
            'select' => array('ID', 'UF_LANG_NAME_' . CURRENT_LANG_UP),
            'limit'  => 10,
        ), false);
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= array('id' => $item['ID'], 'value' => $item['UF_LANG_NAME_' . CURRENT_LANG_UP]);
        }
        jsonresponse(true, '', $items);
        break;
    
    
     // Подсказка для города.
    case ('dictionary-place-city-suggest'):
        $text = (string) $request->get('text');
        $country = (int) $request->get('country');
        
        $filter = array('UF_LANG_NAME_' . CURRENT_LANG_UP => '%'.$text.'%');
        
        if ($country > 0) {
            $filter['=UF_COUNTRY'] = $country;
        }
        
        $result = Glyf\Oscar\Dictionaries\PlaceCity::getList(array(
            'order'  => array('UF_SORT' => 'ASC', 'UF_LANG_NAME_' . CURRENT_LANG_UP => 'ASC'),
            'filter' => $filter,
            'select' => array('ID', 'UF_LANG_NAME_' . CURRENT_LANG_UP),
            'limit'  => 10,
        ), false);
        
        $items = array();
        while ($item = $result->fetch()) {
            $items []= array('id' => $item['ID'], 'value' => $item['UF_LANG_NAME_' . CURRENT_LANG_UP]);
        }
        jsonresponse(true, '', $items);
        break;
    
    
    // Добавление в корзину.
    case ('add-to-cart'):
        $pid = (string) $request->get('pid');
        
        $picture = new Glyf\Oscar\Picture($pid);
        
        $basket = array(
            'FUSER_ID'   => CSaleBasket::GetBasketUserID(),
            'PRODUCT_ID' => $picture->getID(),
            'NAME'       => $picture->getTitle(),
            'PRICE'      => 0,
            'MODULE'     => 'catalog',
            'CURRENCY'   => CURRENCY_DEFAULT,
            'QUANTITY'   => 1,
            'LID'        => SITE_DEFAULT,
            'CAN_BUY'    => 'Y',
            'DELAY'      => 'Y',
            'PROPS'      => array()
        );
        
        if (!CSaleBasket::Add($basket)) {
            jsonresponse(false);
        }
        
        $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'ORDER_ID' => 'NULL'));
        $count  = (int) $result->SelectedRowsCount();
        
        jsonresponse(true, '', array('count' => $count));
		break;
    
    
	default:
		jsonresponse(false, '', array(), 'Internal error');
		break;
}