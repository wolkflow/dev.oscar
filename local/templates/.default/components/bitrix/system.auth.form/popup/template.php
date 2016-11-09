<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arParams["~AUTH_RESULT"]) || !empty($arResult['ERROR_MESSAGE'])) { ?>
	<? $arResult['ERROR_MESSAGE'] = str_replace('.', '', reset($arResult['ERROR_MESSAGE'])) ?>
	<script>
		$(document).ready(function() {
			$('#modal-authorize').arcticmodal();
			console.log('Document ready')
		});
	</script>
<? } ?>

<div class="modal modal-login" id="modal-authorize">
	<div class="modalTitle">
		<?= getMessage('GL_AUTHORIZATION') ?>
		<div class="modalClose arcticmodal-close"></div>
	</div>
	<? //print_r($arParams) ?>
	<? //print_r($arResult) ?>
	<div class="modalContent">
		<form name="system_auth_form<?= $arResult['RND'] ?>" method="post">
            <div class="form-error">
                <?= $arResult['ERROR_MESSAGE'] ?>
            </div>
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<? if (strlen($arResult['BACKURL']) > 0) { ?>
				<input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
			<? } else { ?>
				<input type="hidden" name="backurl" value="/" />
			<? } ?>
			<? foreach ($arResult['POST'] as $key => $value) { ?>
				<input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
			<? } ?>
			
			<ul class="formList">
				<li>
					<label for="regmail">
						<?= getMessage('GL_EMAIL') ?>
					</label>
					<input type="text" id="regmail" name="USER_LOGIN" />
				</li>
				<li>
					<label for="regpass">
						<?= getMessage('GL_PASSWORD') ?>
					</label>
					<input type="password" id="regpass" name="USER_PASSWORD" />
				</li>
				<li>
					<br/>
					<input type="submit" value="ОК" />
				</li>
			</ul>
		</form>
	</div>
</div>