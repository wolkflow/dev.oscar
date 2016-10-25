<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? \Bitrix\Main\Loader::includeModule('glyf.core') ?>

<? use Bitrix\Main\Localization\Loc; ?>
<? use Glyf\Core\Helpers\Text as TextHelper; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="partnersBot">
		<div class="content">
			<div class="container">
				<article class="text">
					<h3>
						<?= getMessage('GL_OUR_PARTNERS') ?>
					</h3>
					<div class="row">
						<? foreach ($arResult['ITEMS'] as $item) { ?>
							<div class="col-sm-12 col-md-3 col-lg-2 partnerItem">
								<? if (!empty($item['PREVIEW_PICTURE']['SRC'])) { ?>
									<div class="partnerItemLogo">
										<img src="/i.php?src=<?= $item['PREVIEW_PICTURE']['SRC'] ?>&w=72&h=72" />
									</div>
								<? } ?>
								<div class="partnerItemTitle">
									<?= $item['PROPERTIES']['LANG_TITLE_'.CURRENT_LANG_UP]['VALUE'] ?>
								</div>
								<div class="partnerItemText">
									<?= $item['PROPERTIES']['LANG_TEXT_'.CURRENT_LANG_UP]['VALUE']['TEXT'] ?>
								</div>
							</div>
						<? } ?>
					</div>
					
					<?= $arResult['NAV_STRING'] ?>
					
				</article>
			</div>
		</div>
	</div>
<? } ?>