<? define('PAGE', 'UPLOAD') ?>
<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php'); ?>
<? $APPLICATION->SetTitle("Загрузка изображения"); ?>

<?  // Строка поиска.
	$APPLICATION->IncludeComponent('bitrix:main.include', '', array(
		'AREA_FILE_SHOW' => 'file',
		'PATH' => SITE_TEMPLATE_PATH.'/include/area/main.search.php',
		'EDIT_TEMPLATE' => 'html'
	));
?>

<main class="siteMain page-cabinet">

    <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <!-- Крошки -->
            <ol class="breadcrumb">
                <li><a href="#">Личный кабинет</a></li>
                <li><a href="#">Каталог</a></li>
                <li>Купание красного коня</li>
            </ol>
            <!--// .Крошки -->
            <div class="row">
              <div class="card-image col-md-8 col-sm-7">
                <div class="card-image__container">
                  <img src="/LAYOUT/images/red-horse.jpg" alt="">
                  <div class="card-image__stats">
                    <div class="card-image__stats-block card-image__stats-block--views">
                      <span>580</span>
                      <span>просмотров</span>
                    </div>
                    <div class="card-image__stats-block card-image__stats-block--sells">
                      <span>11</span>
                      <span>продаж</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-right col-md-4 col-sm-5">
                <h1>Купание красного коня</h1>
                <div class="card-meta">
                  <span class="card-meta__key">Автор:</span>
                  <span class="card-meta__value">Васнецов В.М</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Место создания:</span>
                  <span class="card-meta__value">Россия, Москва</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Время создания:</span>
                  <span class="card-meta__value">1881 - 1898</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Техника:</span>
                  <span class="card-meta__value">Холст, масло</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Размеры:</span>
                  <span class="card-meta__value">295,3 х 466 см</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Правообладатель:</span>
                  <span class="card-meta__value">Государственная Третьяковская галерея, Москва</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">Категория:</span>
                  <span class="card-meta__value">Живопись</span>
                </div>
                <div class="card-meta">
                  <span class="card-meta__key">ID:</span>
                  <span class="card-meta__value">56490</span>
                </div>
                <div class="card-right__edit">
                  <a class="btn btn-light btn-filter_edit btn-inline" href="#">Редактировать</a>
                </div>
                <div class="card-description hidden-xs">
                  <div class="card-description__title">Ключевые слова</div>
                  <div class="card-description__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                </div>
                <div class="card-right__edit hidden-xs">
                  <a class="btn btn-light btn-filter_edit btn-inline" href="#">Редактировать</a>
                </div>
              </div>
              <div class="card-left col-md-8 col-sm-7">
                <div class="card-description">
                  <div class="card-description__title">Тип и размер изображения</div>
                  <div class="card-description__text card-description__text--big">JPEG, 3.04MB, 5118px x 3368px</div>
                </div>
                <div class="card-description">
                  <div class="card-description__title">Описание</div>
                  <div class="card-description__text">Прообразом для Ильи Муромца послужил крестьянин Владимирской губернии Иван Петров (позднее - извозчик села Большие Мытищи), которого Васнецов запечатлел на этюде в 1883 году. В былинах Добрыня всегда молод, как и Алёша, но Васнецов почему-то изобразил его зрелым человеком с роскошной бородой. Некоторые исследователи полагают, что чертами лица Добрыня напоминает самого художника. Картина послужила поводом для большого количества анекдотов и сценических миниатюр.</div>
                </div>
                <div class="card-description">
                  <div class="card-description__title">Дополнительная информация</div>
                  <div class="card-description__text">
                    <div class="card-meta">
                      <span class="card-meta__key">Провенанс:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Реставрационные работы:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Техническое состояние:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Заказчик:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Модель:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Эскизы:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                    <div class="card-meta">
                      <span class="card-meta__key">Прочее:</span>
                      <span class="card-meta__value">Lorem ipsum dolor sit amet, consectetur</span>
                    </div>
                  </div>
                </div>
                <div class="card-right__edit">
                  <a class="btn btn-light btn-filter_edit btn-inline" href="#">Редактировать</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</main>

<? require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>