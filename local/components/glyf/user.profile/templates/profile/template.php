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
                    
                    <? if ($arResult['USER']['PARTNER']) { ?>
                        <div class="cabinet-profile__block cabinet-profile__block--gray">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Организация</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['WORK_COMPANY'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['WORK_PHONE'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="#">Изменить данные</a>
                            </div>
                        </div>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Пользователь</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['NAME'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['PERSONAL_MOBILE'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="#">Изменить данные</a>
                            </div>
                        </div>
                    <? } else { ?>
                        <div class="cabinet-profile__block">
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['NAME'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-field">
                                <div class="cabinet-profile__block-field-key">Телефон</div>
                                <div class="cabinet-profile__block-field-value">
                                    <?= $arResult['USER']['PERSONAL_MOBILE'] ?>
                                </div>
                            </div>
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="#">Изменить данные</a>
                            </div>
                        </div>
                    <? } ?>
                        
                        
                    
                    <div class="cabinet-profile__block">
                        <div class="cabinet-profile__block-field">
                            <div class="cabinet-profile__block-field-key">Email</div>
                            <input type="text" class="liveEdit disabled" disabled value="<?= $arResult['USER']['EMAIL'] ?>">
                        </div>
                        <div class="cabinet-profile__block-field">
                            <div class="cabinet-profile__block-field-key">Пароль</div>
                            <div class="cabinet-profile__block-field-value">
                                ************
                            </div>
                        </div>
                        <div class="cabinet-profile__block-buttons">
                            <a class="btn btn-light btn-filter_edit" href="#">Изменить логин</a>
                            <a class="btn btn-light btn-filter_edit" href="#">Изменить пароль</a>
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
                            <div class="cabinet-profile__block-buttons">
                                <a class="btn btn-light btn-filter_edit" href="#">Пополнить баланс</a>
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
                                <a class="btn btn-light btn-filter_edit" href="#">Изменить</a>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>