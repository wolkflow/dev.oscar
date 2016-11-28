<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? \Bitrix\Main\Loader::includeModule('glyf.core') ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="col-sm-12 col-md-4">
	<? if (!empty($arResult['ITEMS'])) { ?>
		<div class="partnersDocs">
			<div class="partnersDocsTitle">
				<?= getMessage('GL_DOCUMENTS') ?>
			</div>
			<div class="partnersDocsList">
				<ul>
					<? foreach ($arResult['ITEMS'] as $item) { ?>
						<? $filesrc = CFile::getPath($item['PROPERTIES']['LANG_FILE_'.CURRENT_LANG_UP]['VALUE']); ?>
						<li>
							<a href="<?= $filesrc ?>" target="_blank">
								<?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
								<span class="downloadDocs"></span>
							</a>
						</li>
					<? } ?>
				</ul>
				<div class="partners-download">
					<a href="/upload/documents/all.zip" class="downloadDocsAll hidden-sm" target="_blank">
						<?= getMessage('GL_DOWNLOAD_ARCHIVE') ?>
					</a>
				</div>
			</div>
		</div>
	<? } ?>
</div>