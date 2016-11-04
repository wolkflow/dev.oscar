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
$token = (string) $request->get('TOKEN');



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
    
    
    // Добавление картины в сборник.
    case ('add-to-lightbox'):
        $lid = (int) $request->get('lid');
        $pid = (int) $request->get('pid');
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox($lid);
        
        if (!$lightbox->exists()) {
            jsonresponse(false, 'Сборник не существует');
        }
        
        if ($lightbox->getUserID() != $user->getID()) {
            jsonresponse(false, 'Сборник не найден');
        }
        
        if (!$lightbox->addPicture($pid)) {
            jsonresponse(false, 'Ошибка добавления картины');
        }
        
        jsonresponse(true);
        break;
    
    
    // Удаление сборников.
    case ('lighboxes-delete');
        $lids = (array) $request->get('lids');
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        $rmids = array();
        foreach ($lids as $lid) {
            // Сборник.
            $lightbox = new Glyf\Oscar\Lightbox($lid);
            
            if ($lightbox->getUserID() != $user->getID()) {
                continue;
            }
            $lightbox->delete();
            
            $rmids []= $lid;
        }
        
        jsonresponse(true, '', $rmids);
        break;
    
    
    // Получение ссылки на скачивание.
    case ('get-download-link');
        $pid = (int) $request->get('pid');
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Ссылка.
        $link = null;
        
        if (!$user->isPartner()) {
            $tariff = $user->getUserTariff();
            
            if ($tariff) {
                // Ссылка на скачивание.
                if ($tariff->canDownload()) {
                    $picture = new Glyf\Oscar\Picture($pid);
                    
                    if ($picture->exists()) {
                        $link = $picture->getDownloadLink();
                        
                        
                        // Добавление скачивания в статистику.
                        $download = new Glyf\Oscar\Statistic\Download();
                        $download->add(array(
                            Glyf\Oscar\Statistic\Download::FIELD_TIME        => date('d.m.Y H:i:s'),
                            Glyf\Oscar\Statistic\Download::FIELD_USER_ID     => $user->getID(),
                            Glyf\Oscar\Statistic\Download::FIELD_UPLOADER_ID => $picture->getUserID(),
                            Glyf\Oscar\Statistic\Download::FIELD_ELEMENT_ID  => $picture->getID(),
                        ));
                    } else {
                        jsonresponse(false, 'Изображение не существует');
                    }
                } else {
                    jsonresponse(false, 'У вас исчерпан лимит скачиваний');
                }
            } else {
                jsonresponse(false, 'У вас нет нужного тарифа');
            }
        } else {
            jsonresponse(false, 'Вы не можете скачать изображение');
        }
        
        jsonresponse(true, '', array('link' => $link));
        break;
    
    
    // Изменение данных профиля пользователя.
    case ('update-user-profile');
        $name  = (string) $request->get('name');
        $phone = (string) $request->get('phone');
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_NAME => $name,
            Glyf\Oscar\User::FIELD_PERSONAL_MOBILE => $phone,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, 'Ошибка сохранения данных');
        }
        jsonresponse(true);
        break;
    
    
    // Изменение данных профиля компании.
    case ('update-user-company');
        $company = (string) $request->get('company');
        $phone   = (string) $request->get('workphone');
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_WORK_COMPANY => $company,
            Glyf\Oscar\User::FIELD_WORK_PHONE => $phone,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, 'Ошибка сохранения данных');
        }
        jsonresponse(true);
        break;
    
    
    // Изменение e-mail.
    case ('update-user-email');
        $email = (string) $request->get('email');
        
        if (empty($email)) {
            jsonresponse(false, 'Не введен e-mail');
        }
        
        $exist = Glyf\Oscar\User::findByLogin($email);
        if (!is_null($exist)) {
            jsonresponse(false, 'Такой e-mail уже существует');
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_LOGIN => $email,
            Glyf\Oscar\User::FIELD_EMAIL => $email,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, 'Ошибка сохранения e-mail');
        }
        
        jsonresponse(true);
        break;
    
    
    // Изменение пароля.
    case ('update-user-password');
        break;
    
    
	default:
		jsonresponse(false, '', array(), 'Internal error');
		break;
}