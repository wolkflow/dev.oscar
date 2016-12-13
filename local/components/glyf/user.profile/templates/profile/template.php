<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="cabinet-profile col-md-3 col-sm-3">
    <div class="cabinet-block cabinet-block-profile is-active">
        <div class="cabinet-panel">
            <div class="cabinet-panel__toggler"><?= getMessage('GL_PROFILE') ?></div>
        </div>
        <div class="cabinet-block-content">
            <div class="cabinet-profile-sr sidebarRight">
                <div class="sidebarRightTitle hidden-xs"><?= getMessage('GL_PROFILE') ?></div>
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
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_ORGANIZATION') ?></div>
                                <input type="text" name="company" class="le disabled" disabled data-le="company" value="<?= $arResult['USER']['WORK_COMPANY'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_PHONE') ?></div>
                                <input type="text" name="workphone" class="le disabled" disabled data-le="company" value="<?= $arResult['USER']['WORK_PHONE'] ?>">
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="company" href="#"><?= getMessage('GL_CHANGE_DATA') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="company" data-action="update-user-company" href="javascript:void(0)"><?= getMessage('GL_SAVE') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="company" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
                            </div>
                        </div>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_USER') ?></div>
                                <input type="text" name="name" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['NAME'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_PHONE') ?></div>
                                <input type="text" name="phone" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['PERSONAL_MOBILE'] ?>">
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="profile" href="#"><?= getMessage('GL_CHANGE_DATA') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="profile" data-action="update-user-profile" href="javascript:void(0)"><?= getMessage('GL_SAVE') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="profile" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
                            </div>
                        </div>
                    <? } else { ?>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <input type="text" name="name" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['NAME'] ?>">
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_PHONE') ?></div>
                                <div class="cabinet-profile__block-field-value">
                                    <input type="text" name="phone" class="le disabled" disabled data-le="profile" value="<?= $arResult['USER']['PERSONAL_MOBILE'] ?>">
                                </div>
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit le le-start" data-le="profile" href="javascript:void(0)"><?= getMessage('GL_CHANGE_DATA') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="profile" data-action="update-user-profile" href="javascript:void(0)"><?= getMessage('GL_SAVE') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="profile" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
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
                            <div class="cabinet-profile__block-field-key"><?= getMessage('GL_PASSWORD') ?></div>
                            <input type="password" name="password" disabled value="************" class="le disabled" data-le="password" />
                        </div>
                        <div class="cabinet-profile__block-field le disabled" data-le="password">
                            <div class="cabinet-profile__block-field-key"><?= getMessage('GL_CONFIRM_PASSWORD') ?></div>
                            <input type="password" name="oonfirm" value="" class="le disabled" data-le="password" />
                        </div>
                        
                        <div class="cabinet-profile__block-buttons">
                            <a class="btn btn-light btn-filter_edit le le-start" href="javascript:void(0)" data-le="email"><?= getMessage('GL_CHANGE_LOGIN') ?></a>
                            <a class="btn btn-light btn-filter_edit le le-start" href="javascript:void(0)" data-le="password"><?= getMessage('GL_CHANGE_PASSWORD') ?></a>
                            <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-save disabled" data-action="update-user-email" href="javascript:void(0)"><?= getMessage('GL_SAVE') ?></a>
                            <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <? if (!$arResult['USER']['PARTNER']) { ?>
                <div class="cabinet-profile-sr sidebarRight">
                    <div class="sidebarRightTitle"><?= getMessage('GL_TARIFF_BALANCE') ?></div>
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
                                    <a class="btn btn-light btn-filter_edit" href="#"><?= getMessage('Extend') ?></a>
                                    <a class="btn btn-light btn-filter_edit" href="#"><?= getMessage('GL_CHANGE') ?></a>
                                </div>
                            </div>
                            
                            <? if ($arResult['TARIFF']['MULTIPLE'] || 1) { ?>
                                <input id="js-field-multiple-copy-id" type="text" name="ips" class="le disabled" style="display:none;" disabled data-le="multiple" value="" />
                                <div class="cabinet-profile__block">
                                    <div class="cabinet-profile__block-field">
                                        <div class="cabinet-profile__block-field-key"><?= getMessage('GL_AVAILABLE_IP') ?></div>
                                        <div id="js-field-multiple-wrapper-id" class="cabinet-profile__block-field-value">
                                            <? if (1) { ?>
                                                <input type="text" name="ips[0]" class="le disabled removable" disabled data-le="multiple" value="192.168.0.1" />
                                                <input type="text" name="ips[1]" class="le disabled removable" disabled data-le="multiple" value="192.168.0.3" />
                                                <input type="text" name="ips[2]" class="le disabled removable" disabled data-le="multiple" value="192.168.0.7" />
                                            <? } ?>
                                        </div>
                                        <a id="js-field-multiple-copy-insert-id" class="btn btn-light btn-filter_edit btn-filter_subedit hidden" data-link="multiple" data-le="multiple" href="javascript:void(0)">
                                            <?= getMessage('GL_ADD') ?>
                                        </a>
                                     </div>
                                    <div class="cabinet-profile__block-buttons">
                                        <a class="btn btn-light btn-filter_edit le le-start" data-le="multiple" href="javascript:void(0)"><?= getMessage('GL_CHANGE_DATA') ?></a>
                                        <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="multiple" data-action="update-user-multiple-ips" href="javascript:void(0)"><?= getMessage('GL_SAVE') ?></a>
                                        <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="multiple" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
                                    </div>
                                </div>
                            <? } ?>
                        <? } ?>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_AVAILABLE') ?></div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['BALANCE'] ?> <gl>GL_R</gl>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-field le disabled" data-le="pay">
                                <div class="cabinet-profile__block-field-key"><?= getMessage('GL_ENTER_AMOUNT') ?></div>
                                <input type="text" name="price" class="le" data-le="pay" value="1000" />
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end disabled" data-le="pay" data-action="pay-balance" data-callback="cPayBalance" href="javascript:void(0)"><?= getMessage('GL_REFILL') ?></a>
                                <a class="btn btn-light btn-filter_edit btn-filter_edit-small le le-end le-cancel disabled" data-le="pay" href="javascript:void(0)"><?= getMessage('GL_CANCEL') ?></a>
                                <a class="btn btn-light btn-filter_edit le le-start" href="#" data-le="pay"><?= getMessage('GL_REPLENISH_BALANCE') ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cabinet-profile-sr sidebarRight">
                    <div class="sidebarRightTitle"><?= getMessage('GL_SUBSCRIPTION') ?></div>
                    <div class="cabinet-profile__container">
                        <div class="cabinet-profile__block cabinet-profile__block--gray">
                            <ul class="cabinet-profile__block-list">
                                <li><?= getMessage('GL_NEW_COLLECTION') ?></li>
                                <li><?= getMessage('GL_NEWS_BLOG') ?></li>
                                <li><?= getMessage('GL_STOCK') ?></li>
                            </ul>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="/personal/subscribe/"><?= getMessage('GL_CHANGE') ?></a>
                                <? /*
                                <a class="btn btn-light btn-filter_edit" data-modal="#error">Окно ошибки</a>
                                */ ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>
