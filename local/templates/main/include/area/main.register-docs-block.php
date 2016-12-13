<? use Bitrix\Main\Localization\Loc; ?>
<? IncludeAreaLangFile(__FILE__); ?>

<div class="mainShortcuts">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8 col-lg-offset-2">
				<div class="row">
					<div class="col-sm-6 shortcut shortcutRegister">
						<a href="javascript:void(0)" data-modal="#modal-register">
							<div class="shortcutIcon"></div>
							<div class="shortcutTitle">
								<?= getMessage('GL_REGISTRATION') ?>
							</div>
							<div class="shortcutText">
								<?= getMessage('GL_MAIN_REGISTRATION_NOTE') ?>
							</div>
						</a>
					</div>
					<div class="col-sm-6 shortcut shortcutDocs">
						<a href="/documents/">
							<div class="shortcutIcon"></div>
							<div class="shortcutTitle">
								<?= getMessage('GL_MAIN_DOCUMENTS') ?>
							</div>
							<div class="shortcutText">
								<?= getMessage('GL_MAIN_DOCUMENTS_NOTE') ?>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>