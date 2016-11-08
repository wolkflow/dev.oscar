<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Collection; ?>
<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['LIGHTBOX'])) { ?>
    
        
    <ol class="breadcrumb">
        <li><a href="/personal/">Профиль</a></li>
        <li><?= $arResult['LIGHTBOX']['UF_TITLE'] ?></li>
    </ol>
    
    <div class="cabinet-panel clearfix">
        <div class="cabinet-panel__switch">
            <span class="is-active">
                <?= $arResult['LIGHTBOX']['UF_TITLE'] ?>
            </span>
        </div>
        <div class="cabinet-panel__toggler">Коллекции</div>
        <div class="cabinet-panel__menu">
            <a class="is-active" href="#">сохранить пдф</a>
            <a class="is-active" href="#">отправить по email</a>
            <a href="#">печать</a>
            <a href="#">Добавить в корзину</a>
            <a class="is-active" href="#">удалить</a>
        </div>
    </div>

    <div class="lightboxes-set">
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">Демон</div>
                <div class="lightboxes-setDesc">Врубель М. А.</div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">Заголовок длиною больше чем две строки для теста</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-2.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">богатыри</div>
                <div class="lightboxes-setDesc">васнецов В.</div>
            </div>
            <div class="clearfix visible-sm-block visible-md-block"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">жемчужина</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">полет фауста и мефистофеля</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="clearfix visible-lg-block"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">Демон</div>
                <div class="lightboxes-setDesc">Врубель М. А.</div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="clearfix visible-sm-block visible-md-block"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">Заголовок длиною больше чем две строки для теста</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">богатыри</div>
                <div class="lightboxes-setDesc">васнецов В.</div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--copyright" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">жемчужина</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="clearfix visible-sm-block visible-md-block"></div>
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-13">
                <div class="lightboxes-setImage">
                    <img src="media/lightboxes-set-1.png" alt="">
                </div>
                <div class="lightboxes-setAction">
                    <input type="checkbox">
                    <div class="lightboxes-setAction-buttons">
                        <a class="card-image__button card-image__button--cart" href="#"></a>
                    </div>
                </div>
                <div class="lightboxes-setTitle">полет фауста и мефистофеля</div>
                <div class="lightboxes-setDesc">Петров-Водкин К. С.</div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="clearfix visible-lg-block"></div>
        </div>
        <div class="row">
            <div class="cabinet-pagination hidden-xs">
                <div class="cabinet-pagination__count"><span class="current">1</span> из 5</div>
                <div class="cabinet-pagination__buttons">
                    <div class="cabinet-pagination__button cabinet-pagination__button--prev">‹</div>
                    <div class="cabinet-pagination__button cabinet-pagination__button--next is-active">›</div>
                </div>
            </div>
        </div>
    </div>
<? } else { ?>
    <p><?= getMessage('GL_NO_FOUND') ?></p>
<? } ?>