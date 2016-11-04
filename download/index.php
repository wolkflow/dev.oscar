<?php

define('NO_KEEP_STATISTIC', true);
define('PULL_AJAX_INIT', true);
define('PUBLIC_AJAX_MODE', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('DisableEventsCheck', true);

require ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

// JWT.
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/JWT.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/BeforeValidException.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/ExpiredException.php');
require ($_SERVER['DOCUMENT_ROOT'].'/local/vendors/jwt/src/SignatureInvalidException.php');


use \Firebase\JWT\JWT;
use \Firebase\JWT\BeforeValidException;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;


\Bitrix\Main\Loader::includeModule('glyf.core');
\Bitrix\Main\Loader::includeModule('glyf.oscar');


// Запрос.
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

// Действие.
$token = (string) $request->get('TOKEN');


// Ошибка.
$error = null;

try {
    $info = JWT::decode($token, JWT_KEY, array('HS256'));
} catch (SignatureInvalidException $e) {
    $error = 'Неверная ссылка';
} catch (ExpiredException $e) {
    $error = 'Ссылка истекла';
} catch (BeforeValidException $e) {
    $error = 'Ссылка не активна';
} catch (UnexpectedValueException $e) {
    $error = 'Неизвестная ошибка';
} catch (Exception $e) {
    $error = 'Неизвестная ошибка';
}

if (empty($error) && empty($info->user)) {
    $error = 'Не найден пользователь';
}

if (empty($error) && empty($info->image)) {
    $error = 'Не найдено изображение';
}

// Пользователь.
$user = new Glyf\Oscar\User($info->user);

// Изображение.
$picture = new Glyf\Oscar\Picture($info->image);

// Логирование.
// TODO: ...

if (empty($error)) {

    // Отправка изобраэжения.
    $image = new Imagick($_SERVER['DOCUMENT_ROOT'] . $picture->getFullImageSrc());

    header('Content-Type: image/' . $image->getImageFormat());

    echo $image;
    
    exit();
}


?>
<html>
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<title>Ошибка скачивания</title>
    
        <? $APPLICATION->ShowHead() ?>
    </head>
    <body class="mainPage">
        <header class="siteHeader">
            <div class="container">
                <div class="logo">
                    <a href="/">
                        <img src="/local/templates/main/images/logo.png" alt="OSCAR art agency" />
                    </a>
                </div>
            </div>
        </header>
        <main class="siteMain">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                        <div class="errorPage">
                            <div class="errorPageTitle-sub">
                                Ошибка скачивания
                            </div>
                            <div class="errorPageTitle">
                                <?= $error ?>
                            </div>
                            
                            <div class="errorPageMessage">
                                Проверьте наличие необходимого тарифа<br>
                                или напишите нам
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>






