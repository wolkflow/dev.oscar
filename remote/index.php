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
        $pids = (array) $request->get('pid');
        $pids = array_filter(array_map('intval', $pids));
        
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
    
    
    // Добавление в корзину.
    case ('remove-from-cart'):
        $bids = (array) $request->get('bids');
        $bids = array_filter(array_map('intval', $bids));
        
        $result = array();
        foreach ($bids as $bid) {
            if (CSaleBasket::Delete($bid)) {
                $result []= (int) $bid;
            }
        }
        jsonresponse(true, '', array('bids' => $result));
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
        
    
    // Создание сборника.
    case ('create-lightbox'):
        $title = (string) $request->get('title');
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        $result = Glyf\Oscar\Lightbox::getList(array(
            'filter' => array(Glyf\Oscar\Lightbox::FIELD_TITLE => $title, Glyf\Oscar\Lightbox::FIELD_USER => $user->getID()),
            'limit'  => 1
        ), false);
        
        if ($result->getSelectedRowsCount() > 0) { 
            jsonresponse(false, 'Сборник с таким названием уже существует');
        }
        
        // Сборник.
        $lightbox = new Glyf\Oscar\Lightbox();
        $data = array(
            Glyf\Oscar\Lightbox::FIELD_TITLE => $title,
            Glyf\Oscar\Lightbox::FIELD_USER  => $user->getID(),
            Glyf\Oscar\Lightbox::FIELD_TIME  => date('d.m.Y H:i:s')
        );
        if (!$lightbox->add($data)) {
            jsonresponse(false, 'Ошибка создания сборника');
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
                        $picture->recordStatisticLoad($user->getID());
                        
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
        $password = (string) $request->get('password');
        $confirm  = (string) $request->get('confirm');
        
        if (empty($password)) {
            jsonresponse(false, 'Не введен пароль');
        }
        
        if (empty($confirm)) {
            jsonresponse(false, 'Не введено подтверждение пароля');
        }
        
        if ($password != $confirm) {
            jsonresponse(false, 'Пароль и подтверждение не совпадают');
        }
        
        $user = new Glyf\Oscar\User();
        $data = array(
            Glyf\Oscar\User::FIELD_PASSWORD => $password
        );
        
        if (!$user->update($data)) {
            jsonresponse(false, 'Ошибка изменения пароля');
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
            //jsonresponse(false, 'Не доступен необходимый тариф');
        }
        
        if (!$tariff->canMultipleIP()) {
            //jsonresponse(false, 'Не доступен необходимый тариф');
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
                jsonresponse(false, 'Ошибка сохрнениея IP адресов');
            }
        }
        
        if (count($ipaddresses) != count($ips)) {
            jsonresponse(false, 'Ошибка сохрнениея IP адресов');
        }
        
        jsonresponse(true);
        break;
    
    
    // Сохранение поиска.
    case ('save-search');
        $title  = (string) $request->get('title');
        $filter = (array) $request->get('filter');
        
        $title = trim($title);
        
        if (empty($title)) {
            jsonresponse(false, 'Не введено название поиска');
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
            jsonresponse(false, 'Ошибка сохрнениея поиска');
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
            jsonresponse(false, 'Сборник не найден');
        }
        
        if ($lightbox->getUserID() != $user->getID()) {
            jsonresponse(false, 'Сборник не найден');
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
        $licenses = Glyf\Oscar\License::getList(array('filter' => array(Glyf\Oscar\License::FIELD_ROOT => $lid)));
        
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
            // jsonresponse(false, 'Нет прав для добавления папки');
        }
        
        if (empty($title)) {
            jsonresponse(false, 'Не указано название папки');
        }
        
        $data = array(
            Glyf\Oscar\Search::FIELD_TIME   => date('d.m.Y H:i:s'),
            Glyf\Oscar\Search::FIELD_USER   => $user->getID(),
            Glyf\Oscar\Search::FIELD_TITLE  => $title,
        );
        
        $folder = new Glyf\Oscar\Folder();
        
        if (!$folder->add($data)) {
            jsonresponse(false, 'Ошибка сохрнениея поиска');
        }
        jsonresponse(true);
        break;
    
    
    // Добавление папки.
    case ('remove-folders'):
        $fids = array_filter(array_map('intval', (array) $request->get('fids')));
        
        $user = new Glyf\Oscar\User();
        
        if (!$user->isPartner()) {
            // jsonresponse(false, 'Нет прав для добавления папки');
        }
        
        if (empty($fids)) {
            jsonresponse(false, 'Не указаны папки для удаления');
        }
        
        foreach ($fids as $fid) {
            $folder = new Glyf\Oscar\Folder($fid);
            $folder->delete();
        }
        jsonresponse(true);
        break;
    
    
    // Пополнение счета.
    case ('pay-balance'):
        $price = (float) $request->get('price');
        
        if (!Bitrix\Main\Loader::includeModule('sale')) {
            jsonresponse(false, 'Ошибка пополеннеия счета');
        }
        
        if ($price <= 0) {
            jsonresponse(false, 'Неверно указана сумма для пополнения счета');
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
            'USER_DESCRIPTION' => 'Пополнение счета',
            'PRICE'            => $price,
            'CURRENCY'         => CURRENCY_DEFAULT,
            'USER_ID'          => $user->getID(),
            'PAY_SYSTEM_ID'    => PAYSYSTEM_DEFAULT,
            'DELIVERY_ID'      => DELYVERY_SYSTEM_DEFAULT,
            'TAX_VALUE'        => '',
        ));
        
        if ($oid > 0) {
            // Добавление свойств заказа.
            $order = new \Glyf\Oscar\Order($oid);
            $order->saveProperty(\Glyf\Oscar\Order::PROP_BALANCE_CODE, 'Y');
            
            // Ссылка на оплату.
            $link  = $order->getPaymentURL();
            
            jsonresponse(true, '', array('link' => $link));
        }
        jsonresponse(false, 'Ошибка пополеннеия счета');
        break;
    
    
    // Подготовка картины к покупке по лицензии.
    case ('basket-picture'):
        $lid = (int) $request->get('lid');
        $pid = (int) $request->get('pid');
        $bid = (int) $request->get('bid');
        
        $user = new Glyf\Oscar\User();
        
        if (!CUser::IsAuthorized()) {
            jsonresponse(false, 'Вы не авторизованы');
        }
        
        if ($user->isPartner()) {
            jsonresponse(false, 'Вы являетесь партнером');
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
            jsonresponse(false, 'Товар не найден');
        }
        jsonresponse(true, '', array('pid' => $pid));
        break;
    
    
    // Получение HTML.
    case ('get-html'):
        $include = (string) $request->get('inc');
        
        $html = null;
        
        switch ($include) {
            case ('user.statistic.folder'):
                $html = gethtmlremote('user.statistic.folder.php');
                break;
            case ('user.statistic.folders'):
                $html = gethtmlremote('user.statistic.folders.php');
                break;
            case ('user.statistic.objects'):
                $html = gethtmlremote('user.statistic.objects.php');
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
            case ('buyout.basket'):
                $html = gethtmlremote('buyout.basket.php');
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
		jsonresponse(false, '', array(), 'Internal error');
		break;
}

// lightbox-update
// lightbox-list-refresh = get-html * 









