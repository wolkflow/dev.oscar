<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $this->setFrameMode(true) ?>

<? if (!empty($arResult)) { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="siteFooterMenu">
				<ul class="nav">
					<? foreach ($arResult as $arItem) { ?>
						<li>
							<a href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?></a>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
<? } ?>
                                    