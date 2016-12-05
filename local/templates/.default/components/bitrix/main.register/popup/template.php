<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ERRORS'])) { ?>
	<script>
		$(document).ready(function() {
			$('#modal-register').arcticmodal();
		});
	</script>
<? } ?>

<div class="modal modal-login" id="modal-register">
    <div class="modalTitle">
        <?= getMessage('GL_REGISTRATION') ?>
        <div class="modalClose arcticmodal-close"></div>
    </div>
    <div class="modalContent">
        <form id="js-register-form-id" method="post" action="<?= POST_FORM_ACTION_URI ?>">
            <? if (!empty($arResult['ERROR'])) { ?>
                <div class="form-error">
                    <?= $arResult['ERROR'] ?>
                </div>
            <? } ?>
            
            <input type="hidden" name="register_submit_button" value="Y" />
            <? if (!empty($arResult['BACKURL'])) { ?>
                <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
            <? } else { ?>
                <input type="hidden" name="backurl" value="<?= (!empty($_COOKIE['backurl'])) ? (strval($_COOKIE['backurl'])) :("/") ?>" />
            <? } ?>
            
            <ul class="formList">
                <li>
                    <label for="regname"><?= getMessage('GL_NAME') ?></label>
                    <input type="text" id="regname" name="REGISTER[NAME]" value="<?= $arResult['VALUES']['NAME'] ?>" />
                    <? if (!empty($arResult['ERRORS']['NAME'])) { ?>
                        <div class="form-notice form-notice_error">
                            <?= getMessage('GL_ERROR_REQUIRED') ?>
                            <span class="form-notice_close"></span>
                        </div>
                    <? } ?>
                </li>
                <li>
                    <label for="reglastname"><?= getMessage('GL_LAST_NAME') ?></label>
                    <input type="text" id="reglastname" name="REGISTER[LAST_NAME]" value="<?= $arResult['VALUES']['LAST_NAME'] ?>" />
                    <? if (!empty($arResult['ERRORS']['LAST_NAME'])) { ?>
                        <div class="form-notice form-notice_error">
                            <?= getMessage('GL_ERROR_REQUIRED') ?>
                            <span class="form-notice_close"></span>
                        </div>
                    <? } ?>
                </li>
                <li>
                    <label for="regorg"><?= getMessage('GL_COMPANY') ?> *</label>
                    <input type="text" id="regorg" name="REGISTER[WORK_COMPANY]" value="<?= $arResult['VALUES']['WORK_COMPANY'] ?>" />
                </li>
                <li>
                    <label for="regpos"><?= getMessage('GL_POSITION') ?> *</label>
                    <input type="text" id="regpos" name="REGISTER[WORK_POSITION]" value="<?= $arResult['VALUES']['WORK_POSITION'] ?>" />
                </li>
                <li>
                    <label for="regmail"><?= getMessage('GL_EMAIL') ?></label>
                    <input type="text" id="regmail" name="REGISTER[LOGIN]" value="<?= $arResult['VALUES']['LOGIN'] ?>" />
                    <? if (!empty($arResult['ERRORS']['LOGIN'])) { ?>
                        <div class="form-notice form-notice_error">
                            <?= getMessage('GL_ERROR_REQUIRED') ?>
                            <span class="form-notice_close"></span>
                        </div>
                    <? } ?>
                </li>
                <li class="reginfo"><span>*</span> <?= getMessage('GL_NOTE') ?></li>
                <li>
                    <label for="regpass"><?= getMessage('GL_PASSWORD') ?></label>
                    <input type="password" id="regpass" name="REGISTER[PASSWORD]" value="<?= $arResult['VALUES']['PASSWORD'] ?>" />
                    <? if (!empty($arResult['ERRORS']['PASSWORD'])) { ?>
                        <div class="form-notice form-notice_error">
                            <?= getMessage('GL_ERROR_REQUIRED') ?>
                            <span class="form-notice_close"></span>
                        </div>
                    <? } ?>
                </li>
                <li>
                    <label for="regpassre"><?= getMessage('GL_PASSWORD_REPEAT') ?></label>
                    <input type="password" id="regpassre" name="REGISTER[CONFIRM_PASSWORD]" value="<?= $arResult['VALUES']['CONFIRM_PASSWORD'] ?>" />
                    <? if (!empty($arResult['ERRORS']['CONFIRM_PASSWORD'])) { ?>
                        <div class="form-notice form-notice_error">
                            <?= getMessage('GL_ERROR_REQUIRED') ?>
                            <span class="form-notice_close"></span>
                        </div>
                    <? } ?>
                </li>
                <li class="reginfo">
                    <label for="regacept">
                        <input type="checkbox" id="regacept" name="AGREEMENT" value="Y" /> 
                        <?= getMessage('GL_AGREE_WITH') ?> <a href="#"><?= getMessage('GL_OFFER_CONTRACT') ?></a>
                    </label>
                </li>
                <li>
                    <input type="submit" value="ОК" />
                </li>
            </ul>
        </form>
    </div>
</div>