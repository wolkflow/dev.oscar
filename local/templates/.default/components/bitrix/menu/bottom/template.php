<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $this->setFrameMode(true) ?>

<? if (!empty($arResult)) { ?>
	<div class="row">
		<div class="col-xs-11 col-xs-offset-1 col-sm-12 col-sm-offset-0">
			<div class="siteFooterMenu">
				<ul class="nav main-menu">
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
                                    