<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-profile col-md-3 col-sm-3">
    <div class="cabinet-block cabinet-block-profile is-active">
        <div class="cabinet-panel">
            <div class="cabinet-panel__toggler">Профиль</div>
        </div>
        <div class="cabinet-block-content">
            <div class="cabinet-profile-sr sidebarRight">
                <div class="sidebarRightTitle hidden-xs">Профиль</div>
                <div class="cabinet-profile__container">


                    <?php
                    /*
                     * le - класс для live edit, от него зависит оформление
                     * le disabled - стиль выключеного инпута для инпута или display:none для дива или ссылки
                     * data-le - группа которой будет управлять нажатие. Так, data-le ставится кнопке которой запускаем механизм, всем блокам которые должны быть показаны/скрыты в данном механизме, инпутам которым надо открыть/скрыть редактирование. Наглядно понятно в блоке "Баланс"
                     *
                     * le-star - триггер запуска
                     * le-end - триггер окончания
                     * le-cancel - дополнительно для le-end. Механизм, при разблокировке инпутов сохраняет их текущее значение в плейсхолдер, и если пользователь потупил понаписал, а потом отменил, возвращает предыдущее значение, а не блокирует инпут с тем что там понаписано. Кроме того, юзверь может видеть что было раньше, как пример заполнения.
                     */
                    ?>

                    <? if ($arResult['USER']['PARTNER']) { ?>
                        <div class="cabinet-profile__block cabinet-profile__block--gray">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Организация</div>
                                <input type="text" name="company" class="le disabled" disabled data-le="company" value="<?= $arResult['USER']['WORK_COMPANY'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <input type="text" name="workphone" class="le disabled" disabled data-le="company" value="<?= $arResult['USER']['WORK_PHONE'] ?>">
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="company" href="#">Изменить данные</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="company" data-action="update-user-company" href="javascript:void(0)">Сохранить</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="company" href="javascript:void(0)">Отменить</a>
                            </div>
                        </div>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Пользователь</div>
                                <input type="text" name="name" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['NAME'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <input type="text" name="phone" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['PERSONAL_MOBILE'] ?>">
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="profile" href="#">Изменить данные</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="profile" data-action="update-user-profile" href="javascript:void(0)">Сохранить</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="profile" href="javascript:void(0)">Отменить</a>
                            </div>
                        </div>
                    <? } else { ?>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <input type="text" name="name" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['NAME'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <div class="cabinet-profile__block-field-value">
                                    <input type="text" name="phone" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['PERSONAL_MOBILE'] ?>">
                                </div>
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="profile" href="javascript:void(0)">Изменить данные</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="profile" data-action="update-user-profile" href="javascript:void(0)">Сохранить</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="profile" href="javascript:void(0)">Отменить</a>
                            </div>
                        </div>
                    <? } ?>

                    
                    <div class="cabinet-profile__block">
                        <div class="cabinet-profile__block-field">
                            <div class="cabinet-profile__block-field-key">Email</div>
                            <input type="text" name="email" class="le disabled" disabled data-le="email" value="<?= $arResult['USER']['EMAIL'] ?>">
                            <? /* input-error */ ?>
                            <? /* <span class="form-tip form-tip-error">Это не шпага, сударь, это арматура</span> */ ?>
                        </div>
                        <div class="cabinet-profile__block-field">
                            <div class="cabinet-profile__block-field-key">Пароль</div>
                            <input type="password" disabled value="************" class="le disabled" data-le="password" />
                        </div>
                        <div class="cabinet-profile__block-field le disabled" data-le="password">
                            <div class="cabinet-profile__block-field-key">Подтвердите пароль</div>
                            <input type="password" value="" class="le disabled" data-le="password" />
                        </div>
                        
                        <div class="cabinet-profile__block-buttons">
                            <a class="btn btn-light btn-filter_edit le le-start" href="javascript:void(0)" data-le="email">Изменить логин</a>
                            <a class="btn btn-light btn-filter_edit le le-start" href="javascript:void(0)" data-le="password">Изменить пароль</a>
                            <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-action="update-user-email" href="javascript:void(0)">Сохранить</a>
                            <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" href="javascript:void(0)">Отменить</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <? if (!$arResult['USER']['PARTNER']) { ?>
                <div class="cabinet-profile-sr sidebarRight">
                    <div class="sidebarRightTitle">Тарифный план и баланс</div>
                    <div class="cabinet-profile__container">
                        <? if (!empty($arResult['TARIFF'])) { ?>
                            <div class="cabinet-profile__block cabinet-profile__block--gray">
                                <div class="cabinet-profile__block-field">
                                    <div class="cabinet-profile__block-field-value">
                                        <?= $arResult['TARIFF']['NAME'] ?>
                                    </div>
                                </div>
                                <div class="cabinet-profile__block-field">
                                    <div class="cabinet-profile__block-field-key">
                                        Срок действия истекает <?= $arResult['TARIFF']['EXPIRE'] ?>
                                    </div>
                                </div>
                                <div class="cabinet-profile__block-buttons">
                                    <a class="btn btn-light btn-filter_edit" href="#">Продлить</a>
                                    <a class="btn btn-light btn-filter_edit" href="#">Изменить</a>
                                </div>
                            </div>
                        <? } ?>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Доступно</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['BALANCE'] ?> р.
                                </div>
                            </div>
                            <div class="cabinet-profile__block-field le disabled" data-le="pay">
                                <div class="cabinet-profile__block-field-key">Введите сумму</div>
                                <input type="text" class="le" data-le="pay" value="1000">
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="pay" href="javascript:void(0)">Пополнить</a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="pay" href="javascript:void(0)">Отменить</a>
                                <a class="btn btn-light btn-filter_edit le le-start" href="#" data-le="pay">Пополнить баланс</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cabinet-profile-sr sidebarRight">
                    <div class="sidebarRightTitle">Подписки</div>
                    <div class="cabinet-profile__container">
                        <div class="cabinet-profile__block cabinet-profile__block--gray">
                            <ul class="cabinet-profile__block-list">
                                <li>Новые коллекции</li>
                                <li>Новости блога</li>
                                <li>Акции</li>
                            </ul>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="/personal/subscribe/">Изменить</a>
                                <a class="btn btn-light btn-filter_edit" data-modal="#error">Окно ошибки</a>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>

<!-- Окно ошибки -->
<div class="hide">
    <div class="modal modal-error" id="error">
        <div class="modalTitle">
            Ошибка!		<div class="modalClose arcticmodal-close"></div>
        </div>
        <div class="modalContent">
            <div class="errorCode">Шеф! Усё пропало!</div>
            <div class="errorText">Что сломалось не знаем, но половину уже починили. Ожидайте на линии как можно дольше.</div>
        </div>
    </div>
</div>
<!--// .Окно ошибки -->