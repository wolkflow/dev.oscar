<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="categoryLinks">
	<ul>
		<? if (!empty($arResult['SECTIONS'])) { ?>
			<? foreach ($arResult['SECTIONS'] as $section) { ?>
				<li <?= ($arParams['SECTION'] == $section['CODE']) ? ('class="active"') : ('') ?>>
					<a href="<?= $section['SECTION_PAGE_URL'] ?>">
						<?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
					</a>
				</li>
			<? } ?>
		<? } ?>
		<li <?= (empty($arParams['SECTION'])) ? ('class="active"') : ('') ?>>
			<a href="/blog/"><?= getMessage('GL_ALL_ARTICLES') ?></a>
		</li>
	</ul>
</div>