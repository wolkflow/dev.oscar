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

IncludeFileLangFile(__FILE__);

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
    
    // Отправка формы контактов.
    case ('send-form-contacts'):
        
        $result = $APPLICATION->IncludeComponent(
			"glyf:form.mail",
			"contacts",
			array(
				'FORM'     => 'GL_CONTACT',
				'CAPTCHA'  => 'N',
				'FIELDS'   => array('NAME', 'PHONE', 'EMAIL'),
				'REQUIRED' => array('NAME', 'PHONE', 'EMAIL'),
                'VISUAL'   => 'N'
			)		
		);
        
        if ($result['SUCCESS']) {
            jsonresponse(true, $result['MESSAGE']);
        }
        jsonresponse(false, implode('<br/>', $result['ERRORS']));
        break;
	
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
        $pids = (array) $request->get('pid');
        $pids = array_filter(array_map('intval', $pids));
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        foreach ($pids as $pid) {
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
        }
        
        $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'ORDER_ID' => 'NULL'));
        $count  = (int) $result->SelectedRowsCount();
        
        jsonresponse(true, '', array('count' => $count));
		break;
    
    
    // Удаление из предварительной покупки.
    case ('remove-from-delays'):
        $bids = (array) $request->get('bids');
        $bids = array_filter(array_map('intval', $bids));
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        $result = array();
        foreach ($bids as $bid) {
            if (CSaleBasket::Delete($bid)) {
                $result []= (int) $bid;
            }
        }
        
        $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'ORDER_ID' => 'NULL'));
        $count  = (int) $result->SelectedRowsCount();
        
        jsonresponse(true, '', array('bids' => $result, 'count' => $count));
		break;
    
    
    // Удаление из корзины.
    case ('remove-from-basket'):
        $bids = (array) $request->get('bids');
        $bids = array_filter(array_map('intval', $bids));
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        $result = array();
        foreach ($bids as $bid) {
            if (CSaleBasket::Update($bid, array('DELAY' => 'Y', 'PRICE' => 0, 'TYPE' => 0))) {
                $result []= (int) $bid;
            }
        }
        jsonresponse(true, '', array('bids' => $result));
		break;
        break;
    
    
    // Добавление картины в сборник.
    case ('add-to-lightbox'):
        $lid = (int) $request->get('lid');
        $pid = (int) $request->get('pid');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox($lid);
        
        if (!$lightbox->exists()) {
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_NO_EXISTS'));
        }
        
        if ($lightbox->getUserID() != $user->getID()) {
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_NOT_FOUND'));
        }
        
        if (!$lightbox->addPicture($pid)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_INSERT_PICTURE'));
        }
        jsonresponse(true);
        break;
        
    
    // Создание сборника.
    case ('create-lightbox'):
        $title = (string) $request->get('title');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        $result = Glyf\Oscar\Lightbox::getList(array(
            'filter' => array(Glyf\Oscar\Lightbox::FIELD_TITLE => $title, Glyf\Oscar\Lightbox::FIELD_USER => $user->getID()),
            'limit'  => 1
        ), false);
        
        if ($result->getSelectedRowsCount() > 0) { 
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_TITLE_NOT_FOUND'));
        }
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox();
        $data = array(
            Glyf\Oscar\Lightbox::FIELD_TITLE => $title,
            Glyf\Oscar\Lightbox::FIELD_USER  => $user->getID(),
            Glyf\Oscar\Lightbox::FIELD_TIME  => date('d.m.Y H:i:s')
        );
        if (!$lightbox->add($data)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_INSERT_LIGHTBOX'));
        }
        jsonresponse(true);
        break;
    
    
    // Переименование сборника.
    case ('lightbox-change'):
        $lid   = (int) $request->get('lid');
        $title = (string) $request->get('title');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox($lid);
        
        if ($lightbox->getUserID() != $user->getID()) {
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_NOT_FOUND'));
        }
        
        $result = Glyf\Oscar\Lightbox::getList(array(
            'filter' => array(Glyf\Oscar\Lightbox::FIELD_TITLE => $title, Glyf\Oscar\Lightbox::FIELD_USER => $user->getID()),
            'limit'  => 1
        ), false);
        
        if ($result->getSelectedRowsCount() > 0) { 
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_TITLE_ALREADY_EXISTS'));
        }
        
        $data = array(
            Glyf\Oscar\Lightbox::FIELD_TITLE => $title,
        );
        if (!$lightbox->update($data)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_INSERT_LIGHTBOX'));
        }
        jsonresponse(true, '', array('lid' => $lid));
        break;
    
    
    // Добавление сборника в корзину.
    case ('lighboxes-basket');
        $lids = (array) $request->get('lids');
        $lids = array_filter(array_map('intval', $lids));
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        $bids = array();
        foreach ($lids as $lid) {
            // Сборник.
            $lightbox = new Glyf\Oscar\Lightbox($lid);
            
            if ($lightbox->getUserID() != $user->getID()) {
                continue;
            }
            
            // Изображения сборника.
            $pictures = $lightbox->getPictures();
            
            foreach ($pictures as $picture) {
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
                
                if ($bid = CSaleBasket::Add($basket)) {
                    $bids []= $bid;
                }
            }
        }
        
        $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'ORDER_ID' => 'NULL'));
        $count  = (int) $result->SelectedRowsCount();
        
        jsonresponse(true, '', array('bids' => $bids, 'count' => $count));
        break;
    
    
    // Удаление сборников.
    case ('lighboxes-delete');
        $lids = (array) $request->get('lids');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
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
                        $picture->recordStatisticLoad($user->getID());
                        
                    } else {
                        jsonresponse(false, getMessage('GL_ERROR_IMAGE_NOT_EXISTS'));
                    }
                } else {
                    jsonresponse(false, getMessage('GL_ERROR_DOWNLOAD_LIMIT'));
                }
            } else {
                jsonresponse(false, getMessage('GL_ERROR_NO_NEEDED_TARIFF'));
            }
        } else {
            jsonresponse(false, getMessage('GL_ERROR_CANT_DOWNLOAD_IMAGE'));
        }
        
        jsonresponse(true, '', array('link' => $link));
        break;
    
    
    // Изменение данных профиля пользователя.
    case ('update-user-profile');
        $name  = (string) $request->get('name');
        $phone = (string) $request->get('phone');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_NAME => $name,
            Glyf\Oscar\User::FIELD_PERSONAL_MOBILE => $phone,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_DATA'));
        }
        jsonresponse(true);
        break;
    
    
    // Изменение данных профиля компании.
    case ('update-user-company');
        $company = (string) $request->get('company');
        $phone   = (string) $request->get('workphone');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_WORK_COMPANY => $company,
            Glyf\Oscar\User::FIELD_WORK_PHONE => $phone,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_DATA'));
        }
        jsonresponse(true);
        break;
    
    
    // Изменение e-mail.
    case ('update-user-email');
        $email = (string) $request->get('email');
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        if (empty($email)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_ENTER_EMAIL'));
        }
        
        $exist = Glyf\Oscar\User::findByLogin($email);
        if (!is_null($exist)) {
            jsonresponse(false, getMessage('GL_ERROR_EMAIL_ALREADY_EXISTS'));
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_LOGIN => $email,
            Glyf\Oscar\User::FIELD_EMAIL => $email,
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_EMAIL'));
        }
        
        jsonresponse(true);
        break;
    
    
    // Изменение пароля.
    case ('update-user-password');
        $password = (string) $request->get('password');
        $confirm  = (string) $request->get('confirm');
        
        if (empty($password)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_PASSWORD'));
        }
        
        if (empty($confirm)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_CONFIRM_PASSWORD'));
        }
        
        if ($password != $confirm) {
            jsonresponse(false, getMessage('GL_ERROR_DIFFERENT_CONFIRM'));
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_PASSWORD => $password
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_PASSWORD'));
        }
        jsonresponse(true);
        break;
    
    
    // Сохранение доступных IP адресов.
    case ('update-user-multiple-ips');
        $ips = (array) $request->get('ips'); 
        $ips = array_filter(array_map('strval', $ips));
        
        $user = new Glyf\Oscar\User();
        
        // Тариф.
        $tariff = $user->getUserTariff();
        
        if (!$tariff) {
            jsonresponse(false, getMessage('GL_ERROR_NO_NEEDED_TARIFF'));
        }
        
        if (!$tariff->canMultipleIP()) {
            jsonresponse(false, getMessage('GL_ERROR_NO_NEEDED_TARIFF'));
        }
        
        
        // Сохранение списка IP адресов.
        $ipaddresses = array();
        foreach ($ips as $ip) {
            if (!Glyf\Oscar\IPAddress::check($user->getID(), $ip)) {
                continue; // jsonresponse(false, 'Такой адрес уже зарезервирован [' . $ip . ']');
            }
            $ipaddresses []= $ip;
        }
        
        if (!empty($ipaddresses)) {
            $ipaddress = $user->getIPAddress();
            
            $result = $ipaddress->update(array(
                Glyf\Oscar\IPAddress::FIELD_TIME => date('d.m.Y H:i:s'),
                Glyf\Oscar\IPAddress::FIELD_IPS  => $ipaddresses,
            ));
            
            if (!$result) {
                jsonresponse(false, getMessage('GL_ERROR_SAVE_IPS'));
            }
        }
        
        if (count($ipaddresses) != count($ips)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_IPS'));
        }
        
        jsonresponse(true);
        break;
    
    
    // Сохранение поиска.
    case ('save-search');
        $title  = (string) $request->get('title');
        $filter = (array) $request->get('filter');
        
        $title = trim($title);
        
        if (empty($title)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_SEARCH_TITLE'));
        }

        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Добавление просмотра в статистику.
        $search = new Glyf\Oscar\Search();
        
        $data = array(
            Glyf\Oscar\Search::FIELD_TIME   => date('d.m.Y H:i:s'),
            Glyf\Oscar\Search::FIELD_USER   => $user->getID(),
            Glyf\Oscar\Search::FIELD_TITLE  => $title,
            Glyf\Oscar\Search::FIELD_FIELDS => json_encode($filter),
        );
        
        if (!$search->add($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_SEARCH'));
        }
        
        $filter = '/search/?' . http_build_query(array(Glyf\Oscar\Search::FILTERS_CODE => $filter));
        
        jsonresponse(true, '', array('title' => $title, 'filter' => $filter));
        break;
    
    
    
    // Сохранение поиска.
    case ('remove-search');
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Сохраненные поиски.
        $searches = Glyf\Oscar\Search::getList(array('filter' => array(Glyf\Oscar\Search::FIELD_USER => $user->getID())));
        
        foreach ($searches as $search) {
            $search->delete();
        }
        jsonresponse(true);
        break;
    
    
    
    // Удаление картины из сборника.
    case ('remove-from-lightbox'):
        $lid  = (int) $request->get('lid');
        $pids = (array) $request->get('pid');
        $pids = array_filter(array_map('intval', $pids));
        
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox($lid);
        
        if (!$lightbox->exists()) {
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_NOT_FOUND'));
        }
        
        if ($lightbox->getUserID() != $user->getID()) {
            jsonresponse(false, getMessage('GL_ERROR_LIGHTBOX_NOT_FOUND'));
        }
        
        $pics = Glyf\Oscar\LightboxPicture::getList(array(
            'filter' => array(
                Glyf\Oscar\LightboxPicture::FIELD_LIGHTBOX => $lid,
                Glyf\Oscar\LightboxPicture::FIELD_PICTURE  => $pids,
            )
        ));
        
        $pids = array();
        foreach ($pics as $pic) {
            $pid = (int) $pic->getPictureID();
            if ($pic->delete()) {
                $pids []= $pid;
            }
        }
        jsonresponse(true, '', array('pids' => $pids));
        break;
    
    
    // Получение списка лицензий.
    case ('get-licenses'):
        $lid = (int) $request->get('lid');
        
        // Список лицензий.
        $licenses = Glyf\Oscar\License::getList(array(
            'filter' => array(Glyf\Oscar\License::FIELD_ROOT => $lid), 
            'order'  => array(Glyf\Oscar\License::FIELD_ID   => 'ASC')
        ));
        
        $items = array();
        foreach ($licenses as $license) {
            $item = array(
                'id'    => $license->getID(),
                'title' => $license->getTitle(),
                'step'  => $license->getStepTitle(),
                'price' => $license->getPrice(),
            );
            $items []= $item;
        }
        jsonresponse(true, '', array('items' => $items));
        break;
    
    
    // Добавление папки.
    case ('add-folder'):
        $title = (string) $request->get('title');
        $title = trim($title);
        
        
        $user = new Glyf\Oscar\User();
        
        if (!$user->isPartner()) {
            jsonresponse(false, getMessage('GL_ERROR_NO_PERMISSION_FOLDER_INSERT'));
        }
        
        if (empty($title)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_ENTER_FOLDER_TITLE'));
        }
        
        $data = array(
            Glyf\Oscar\Search::FIELD_TIME   => date('d.m.Y H:i:s'),
            Glyf\Oscar\Search::FIELD_USER   => $user->getID(),
            Glyf\Oscar\Search::FIELD_TITLE  => $title,
        );
        
        $folder = new Glyf\Oscar\Folder();
        
        if (!$folder->add($data)) {
            jsonresponse(false, getMessage('GL_ERROR_SAVE_FOLDER'));
        }
        jsonresponse(true);
        break;
    
    
    // Добавление папки.
    case ('remove-folders'):
        $fids = array_filter(array_map('intval', (array) $request->get('fids')));
        
        $user = new Glyf\Oscar\User();
        
        if (!$user->isPartner()) {
            jsonresponse(false, getMessage('GL_ERROR_NO_PERMISSION_FOLDER_DELETE'));
        }
        
        if (empty($fids)) {
            jsonresponse(false, getMessage('GL_ERROR_NO_FOLDERS_FOR_DELETE'));
        }
        
        foreach ($fids as $fid) {
            $folder = new Glyf\Oscar\Folder($fid);
            $folder->delete();
        }
        jsonresponse(true);
        break;
    
    
    // Подготовка картины к покупке по лицензии.
    case ('basket-picture'):
        $lid  = (int) $request->get('lid');
        $pid  = (int) $request->get('pid');
        $bid  = (int) $request->get('bid');
        $rlid = (int) $request->get('rlid');
        
        $user = new Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        if ($user->isPartner()) {
            jsonresponse(false, getMessage('GL_ERROR_YOU_ARE_PARTNER'));
        }
        
        $basket = CSaleBasket::getByID($bid);
        
        if ($basket['ID'] > 0) {
            $license = new glyf\Oscar\License($lid);
            
            CSaleBasket::Update($bid, array(
                'DELAY'    => 'N', 
                'PRICE'    => floatval($license->getPrice()), 
                'TYPE'     => intval($license->getID()),
                'QUANTITY' => 1,
            ));
        } else {
            jsonresponse(false, getMessage('GL_ERROR_PICTURE_NOT_FOUND'));
        }
        jsonresponse(true, '', array('pid' => $pid));
        break;
    
    
    // Пополнение счета.
    case ('pay-balance'):
        $price = (float) $request->get('price');
        
        if (!Bitrix\Main\Loader::includeModule('sale')) {
            jsonresponse(false, getMessage('GL_ERROR_PAY_BALANCE'));
        }
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        if ($price <= 0) {
            jsonresponse(false, getMessage('GL_ERROR_INCORRECT_SUM_BALANCE'));
        }
        
        $user = new Glyf\Oscar\User();
        
        // Добавление заказа.
        $oid = CSaleOrder::Add(array(
            'LID'              => SITE_DEFAULT,
            'PERSON_TYPE_ID'   => PERSON_TYPE_DEFAULT,
            'PAYED'            => 'N',
            'CANCELED'         => 'N',
            'STATUS_ID'        => STATUS_DEFAULT,
            'DISCOUNT_VALUE'   => '',
            'USER_DESCRIPTION' => getMessage('GL_PAY_BALANCE'),
            'PRICE'            => $price,
            'CURRENCY'         => CURRENCY_DEFAULT,
            'USER_ID'          => $user->getID(),
            'PAY_SYSTEM_ID'    => PAYSYSTEM_DEFAULT,
            'DELIVERY_ID'      => DELYVERY_SYSTEM_DEFAULT,
            'TAX_VALUE'        => '',
            'XML_ID'           => \Glyf\Oscar\Order::PROP_BALANCE_CODE,
        ));
        
        if ($oid > 0) {
            // Добавление свойств заказа.
            $order = new \Glyf\Oscar\Order($oid);
            $order->saveProperty(\Glyf\Oscar\Order::PROP_BALANCE_CODE, 'Y');
            
            // Ссылка на оплату.
            $link  = $order->getPaymentURL();
            
            jsonresponse(true, '', array('link' => $link));
        }
        jsonresponse(false, getMessage('GL_ERROR_PAY_BALANCE'));
        break;
    
    
    // Покупка тарифа.
    case ('pay-tariff'):
        $tid = (int) $request->get('tid');
        
        if (!Bitrix\Main\Loader::includeModule('sale')) {
            jsonresponse(false, getMessage('GL_ERROR_BUY_TARIFF'));
        }
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        $tariff = new Glyf\Oscar\Tariff($tid);
        
        if (!$tariff->exists()) {
            jsonresponse(false, getMessage('GL_ERROR_NO_TARIFF'));
        }
        
        $user = new Glyf\Oscar\User();
        
        // Добавление заказа.
        $oid = CSaleOrder::Add(array(
            'LID'              => SITE_DEFAULT,
            'PERSON_TYPE_ID'   => PERSON_TYPE_DEFAULT,
            'PAYED'            => 'N',
            'CANCELED'         => 'N',
            'STATUS_ID'        => STATUS_DEFAULT,
            'DISCOUNT_VALUE'   => '',
            'USER_DESCRIPTION' => getMessage('GL_PAY_TARIFF') . ' "' . $tariff->getTitle() . '"',
            'PRICE'            => floatval($tariff->getPrice()),
            'CURRENCY'         => CURRENCY_DEFAULT,
            'USER_ID'          => $user->getID(),
            'PAY_SYSTEM_ID'    => PAYSYSTEM_DEFAULT,
            'DELIVERY_ID'      => DELYVERY_SYSTEM_DEFAULT,
            'TAX_VALUE'        => '',
            'XML_ID'           => \Glyf\Oscar\Order::PROP_TARIFF_CODE,
        ));
        
        if ($oid > 0) {
            // Добавление свойств заказа.
            $order = new \Glyf\Oscar\Order($oid);
            $order->saveProperty(\Glyf\Oscar\Order::PROP_TARIFF_CODE, 'Y');
            
            // Ссылка на оплату.
            $link  = $order->getPaymentURL();
            
            jsonresponse(true, '', array('link' => $link));
        }
        jsonresponse(false, getMessage('GL_ERROR_PAY_BALANCE'));
        break;
    
    
    // Повторение заказа.
    case ('repeat-orders'):
        $oids = (array) $request->get('oids');
        $oids = array_filter(array_map('intval', $oids));
        
        if (empty($oids)) {
            jsonresponse(false, getMessage('GL_ERROR_EMPTY_ORDERS'));
        }
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        foreach ($oids as $oid) {
            $order = new Glyf\Oscar\Order($oid
            try {
                $order->repeat();
            } catch (\Exception $e) {
                jsonresponse(true, getMessage('GL_ERROR_CANT_REPEAT_ORDER'));
            }
        }
        jsonresponse(true, getMessage('GL_ORDERS_REPEATED'));
        break;
    
    
    // Создание заказа.
    case ('pay-order'):
        $bids = (array) $request->get('bids');
        $bids = array_filter(array_map('intval', $bids));
        
        $user = new Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        
        if ($user->isPartner()) {
            jsonresponse(false, getMessage('GL_ERROR_YOU_ARE_PARTNER'));
        }
        
        $baskets = array();
        
        if (empty($bids)) {
            $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'DELAY' => 'N', 'ORDER_ID' => 'NULL'));
        } else {
            $result = CSaleBasket::GetList(array(), array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'ID' => $bids, 'DELAY' => 'N', 'ORDER_ID' => 'NULL'));
        }
        
        $price = 0;
        while ($basket = $result->fetch()) {
            $baskets[$basket['ID']] = $basket;
            
            $price += (float) $basket['PRICE'];
        }
        
        // Добавление заказа.
        $oid = CSaleOrder::Add(array(
            'LID'              => SITE_DEFAULT,
            'PERSON_TYPE_ID'   => PERSON_TYPE_DEFAULT,
            'PAYED'            => 'N',
            'CANCELED'         => 'N',
            'STATUS_ID'        => STATUS_DEFAULT,
            'DISCOUNT_VALUE'   => '',
            'USER_DESCRIPTION' => getMessage('GL_PAY_TARIFF'),
            'PRICE'            => $price,
            'CURRENCY'         => CURRENCY_DEFAULT,
            'USER_ID'          => $user->getID(),
            'PAY_SYSTEM_ID'    => PAYSYSTEM_DEFAULT,
            'DELIVERY_ID'      => DELYVERY_SYSTEM_DEFAULT,
            'TAX_VALUE'        => '',
            'XML_ID'           => \Glyf\Oscar\Order::PROP_PICTURE_CODE,
        ));
        
        if ($oid > 0) {
            // Привязка корин к заказу.
            foreach ($baskets as $basket) {
                CSaleBasket::Update($basket['ID'], array('ORDER_ID' => $oid));
            }
            
            // Добавление свойств заказа.
            $order = new \Glyf\Oscar\Order($oid);
            $order->saveProperty(\Glyf\Oscar\Order::PROP_PICTURE_CODE, 'Y');
            
            // Ссылка на оплату.
            $link = $order->getPaymentURL();
            
            jsonresponse(true, '', array('link' => $link));
        }
        jsonresponse(false, getMessage('GL_ERROR_CREATE_ORDER'));
        break;
    
    
    // Скачивание PDF - заказы пользователя.
    case ('load-user-orders-pdf'):
        $ids = (array) $request->get('IDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/orders/?' . http_build_query($data);
        $name = 'PDF_ORDERS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - заказы пользователя.
    case ('mail-user-orders-pdf'):
        $ids = (array) $request->get('IDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/orders/?' . http_build_query($data);
        $name = 'PDF_ORDERS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - сборники пользователя.
    case ('load-user-lightboxes-pdf'):
        $ids = (array) $request->get('LIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('LIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_LIGHBOXES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - сборники пользователя.
    case ('mail-user-lightboxes-pdf'):
        $ids = (array) $request->get('LIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('LIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_LIGHBOXES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - изображения пользователя.
    case ('load-pictures-pdf'):
        $ids = (array) $request->get('PIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('PIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_PICTURES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - изображения пользователя.
    case ('mail-pictures-pdf'):
        $ids = (array) $request->get('PIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('PIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_PICTURES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - папки пользователя.
    case ('load-folders-pdf'):
        $ids = (array) $request->get('FIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('FIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_FOLDERS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - папки пользователя.
    case ('mail-folders-pdf'):
        $ids = (array) $request->get('FIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('FIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_FOLDERS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - папки пользователя.
    case ('load-folder-pdf'):
        $ids = (array) $request->get('PIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('PIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_FOLDER_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - папки пользователя.
    case ('mail-folder-pdf'):
        $ids = (array) $request->get('PIDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('PIDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/pictures/?' . http_build_query($data);
        $name = 'PDF_FOLDER_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - история продаж.
    case ('load-sales-pdf'):
        $ids = (array) $request->get('IDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/sales/?' . http_build_query($data);
        $name = 'PDF_SALES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - история продаж.
    case ('mail-sales-pdf'):
        $ids = (array) $request->get('IDS');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID());
        $link = 'http://' . SITENAME . '/screens/sales/?' . http_build_query($data);
        $name = 'PDF_SALES_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    // Скачивание PDF - статистика продаж.
    case ('load-stats-pdf'):
        $ids  = (array)  $request->get('IDS');
        $pmin = (string) $request->get('PERIOD_MIN');
        $pmax = (string) $request->get('PERIOD_MAX');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID(), 'PERIOD_MIN' => $pmin, 'PERIOD_MAX' => $pmax);
        $link = 'http://' . SITENAME . '/screens/stats/?' . http_build_query($data);
        $name = 'PDF_STATS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        jsonresponse(true, '', array('link' => $pdf->getLink()));
        break;
    
    
    // Отправка PDF - статистика продаж.
    case ('mail-stats-pdf'):
        $ids  = (array) $request->get('IDS');
        $pmin = (string) $request->get('PERIOD_MIN');
        $pmax = (string) $request->get('PERIOD_MAX');
        
        $user = new \Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, getMessage('GL_ERROR_NOT_AUTHORIZED'));
        }
        $data = array('IDS' => $ids, 'UID' => $user->getID(), 'PERIOD_MIN' => $pmin, 'PERIOD_MAX' => $pmax);
        $link = 'http://' . SITENAME . '/screens/stats/?' . http_build_query($data);
        $name = 'PDF_STATS_' . $user->getID() . '_' . date('YmdHi');
        
        $pdf = new \Glyf\Oscar\System\ScreenPDF($link, $name);
        $pdf->make();
        
        // Отправка сообщения.
        $result = CEvent::Send(
            'GL_PDF', 
            SITE_ID, 
            array('EMAIL' => $user->getEmail()), 
            'Y', 
            '', 
            array($pdf->getFile(true))
        );
        
        if ($result > 0) {
            jsonresponse(true, getMessage('GL_SEND_MAIL_SUCCESS'));
        }
        jsonresponse(false, getMessage('GL_ERROR_SEND_MAIL'));
        break;
    
    
    
    // Получение HTML.
    case ('get-html'):
        $include = (string) $request->get('inc');
        
        $html = null;
        
        switch ($include) {
            case ('blog.archive'):
                $html = gethtmlremote('blog.archive.php');
                break;
            case ('user.statistic.folder'):
                $html = gethtmlremote('user.statistic.folder.php');
                break;
            case ('user.statistic.folders'):
                $html = gethtmlremote('user.statistic.folders.php');
                break;
            case ('user.statistic.objects'):
                $html = gethtmlremote('user.statistic.objects.php');
                break;
            case ('user.statistic.sales'):
                $html = gethtmlremote('user.statistic.sales.php');
                break;
            case ('user.statistic.sales.objects'):
                $html = gethtmlremote('user.statistic.sales.objects.php');
                break;
            case ('lightbox.list'):
                $html = gethtmlremote('lightbox.list.php');
                break;
            case ('user.lightbox'):
                $html = gethtmlremote('user.lightbox.php');
                break;
            case ('lightbox.block'):
                $html = gethtmlremote('lightbox.block.php');
                break;
            case ('user.orders'):
                $html = gethtmlremote('user.orders.php');
                break;
            case ('picture.delays'):
                $html = gethtmlremote('picture.delays.php');
                break;
            case ('picture.buyout'):
                $html = gethtmlremote('picture.buyout.php');
                break;
            case ('picture.basket'):
                $html = gethtmlremote('picture.basket.php');
                break;
        }
        jsonresponse(true, '', array('html' => $html));
        break;
    
    
	default:
		jsonresponse(false, getMessage('GL_ERROR_UNKNOWN'), array(), getMessage('GL_ERROR_UNKNOWN'));
		break;
}








