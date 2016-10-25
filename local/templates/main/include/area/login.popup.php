<? use Bitrix\Main\Localization\Loc; ?>
<? IncludeAreaLangFile(__FILE__); ?>

<? if (!$USER->IsAuthorized()) { ?>
	<ul class="nav <?= $arParams['CSS'] ?>">
		<li class="login">
			<a href="javascript:void(0)" data-modal="#modal-authorize">
				<?= getMessage('GL_SIGN_IN') ?>
			</a>
		</li>
		<li>
			<a href="javascript:void(0)" data-modal="#modal-register">
				<?= getMessage('GL_REGISTER') ?>
			</a>
		</li>
	</ul>
<? } else { ?>
	<ul class="nav <?= $arParams['CSS'] ?>">
		<li class="login">
			<a href="<?= $APPLICATION->GetCurPageParam('logout=yes', array('logout'), false) ?>">
				<?= getMessage('GL_SIGN_OUT') ?>
			</a>
		</li>
		<li>
			<a href="/profile/">
				<?= getMessage('GL_PROFILE') ?>
			</a>
		</li>
	</ul>
<? } ?>