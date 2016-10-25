<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['PICTURE'])) { ?>
    <div class="col-md-9 col-sm-9">
        
        <ol class="breadcrumb">
            <? $lastitem = array_pop($arResult['NAVIGATION']) ?>
            <? foreach ($arResult['NAVIGATION'] as $item) { ?>
                <li>
                    <a href="<?= $item['LINK'] ?>">
                        <?= $item['TITLE'] ?>
                    </a>
                </li>
            <? } ?>
            <li><?= $lastitem['TITLE'] ?></li>
        </ol>
        <pre><? // print_r($arResult) ?></pre>
        <div class="row card">
            <div class="col-md-8 col-sm-7">
                <div class="card-image__container">
                    <img src="media/card2.png" alt="">
                    <div class="card-image__buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--add" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="card-description">
                    <div class="card-description__title">Тип и размер изображения</div>
                    <div class="card-description__text card-description__text--big">
                        JPEG, 3.04MB, 5118px x 3368px
                    </div>
                </div>
                <div class="card-description">
                    <div class="card-description__title">Описание</div>
                    <div class="card-description__text">
                        <?= $arResult['PICTURE'][Picture::FIELD_LANG_DESC_SFX . CURRENT_LANG_UP] ?>
                    </div>
                </div>
                <div class="card-description">
                    <div class="card-description__title">Дополнительная информация</div>
                    <div class="card-description__text">
                        <div class="card-meta">
                            <span class="card-meta__key">Провенанс:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_PROVENANCE_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Реставрационные работы:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_RESTORATION_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Техническое состояние:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_TECHNICAL_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Заказчик:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_CUSTOMER_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Модель:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_RESTORATION_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Эскизы:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_SKETCHES_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                        <div class="card-meta">
                            <span class="card-meta__key">Прочее:</span>
                            <span class="card-meta__value">
                                <?= $arResult['PICTURE'][Picture::FIELD_OTHER_SFX . CURRENT_LANG_UP] ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">
                <h1>
                    <?= $arResult['PICTURE'][Picture::FIELD_LANG_TITLE_SFX . CURRENT_LANG_UP] ?>
                </h1>
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
                    <span class="card-meta__value">
                        <?= $arResult['PICTURE'][Picture::FIELD_ID] ?>
                    </span>
                </div>
                <div class="card-right__add-to-cart">
                    <a class="btn btn-blue" href="#">Скачать</a>
                    <a class="btn" href="#">Добавить в корзину</a>
                </div>
                <div class="card-description hidden-xs">
                    <div class="card-description__title">Ключевые слова</div>
                    <div class="card-description__text">
                        <?  // Ключевые слова.
                            $keywords = array();
                            foreach ($arResult['PICTURE'][Picture::FIELD_KEYWORDS] as $keyword) {
                                $keywords []= '<a href="/collections/?F[TAGS]=' . $keyword . '">' . $keyword . '</a>';
                            }
                        ?>
                        <?= implode(', ', $keywords) ?>
                    </div>
                </div>
                
                <div class="card-description hidden-xs">
                    <div class="card-description__title">Упоминания в блоге</div>
                    <div class="card-description__text">
                        <div class="archiveList">
                            <article class="archiveArticle text">
                                <a href="#">
                                    <div class="archiveArticleImage">
                                        <img src="media/archive.png" alt="">
                                        <div class="catmark">живопись</div>
                                    </div>
                                    <p>Tortured Genius: Get up close to Russia's cultural icons</p>
                                </a>
                            </article>
                            <article class="archiveArticle text">
                                <a href="#">
                                    <div class="archiveArticleImage">
                                        <img src="media/archive.png" alt="">
                                        <div class="catmark">культура</div>
                                    </div>
                                    <p>Tortured Genius: Get up close to Russia's cultural icons</p>
                                </a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>