<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="row">
		<? foreach ($arResult['ITEMS'] as $item) { ?>
			<div class="col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-0 similar">
				<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
					<div class="similarImage">
						<img src="/i.php?src=<?= $item['PREVIEW_PICTURE']['SRC'] ?>&w=266&h=96" />
						<div class="catmark">
							<?= $item['SECTION_LANG_TITLE'] ?>
						</div>
					</div>
					<p>
						<?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
					</p>
				</a>
			</div>
		<? } ?>
	</div>
<? } ?>