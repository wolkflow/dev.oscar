<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Bitrix\Main\Localization\Loc; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true) ?>

<div class="contactsBlock">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="row">
					<div class="col-xs-12">
						<div class="container-fluid">
							<div class="row contactsBlockInner">
								<div class="col-sm-6 contactsBlockMessage">
									<div class="contactsBlockIcon">
										<img src="<?= SITE_TEMPLATE_PATH ?>/images/contactsBlockIcon.png" />
									</div>
									<div class="contactsBlockTitle">
										<?= getMessage('GL_CONTACT') ?>
									</div>
									<div class="contactsBlockText">
										<?= getMessage('GL_CONTACT_FORM_NOTE') ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="contactsBlockForm">
										<form class="form" method="post" id="js-form-mail-contacts-id">
											<input type="hidden" name="<?= $arParams['FORM'] ?>" value="<?= $arParams['FORM'] ?>" />
											
											<a href="javascript:void(0)" class="contactsBlockForm-submit js-contacts_submit" id="js-form-mail-contacts-submit-id">
												OK
											</a>
											<ul>
												<li>
													<input type="text" placeholder="<?= getMessage('GL_CONTACT_NAME') ?>" name="NAME" value="<?= $arResult['DATA']['NAME'] ?>" />
												</li>
												<li>
													<input type="text" placeholder="<?= getMessage('GL_CONTACT_PHONE') ?>" name="PHONE" value="<?= $arResult['DATA']['PHONE'] ?>" />
												</li>
												<li>
													<input type="text" placeholder="<?= getMessage('GL_CONTACT_EMAIL') ?>" name="EMAIL" value="<?= $arResult['DATA']['EMAIL'] ?>" />
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>