<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<pre>
	<? // print_r($arResult) ?>
</pre>

<? if (!empty($arResult['SECTIONS'])) { ?>
	<div class="container">
		<div class="row">
			<? foreach ($arResult['SECTIONS'] as $section) { ?>
				<div class="col-sm-4 col-md-2">
					<div class="collectionsBlock">
						<div class="collectionsBlockTitle">
							<?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
						</div>
						<div class="collectionsBlockImage">
							<img src="/i.php?src=<?= $section['PICTURE']['SRC'] ?>&w=169&h=44" />
						</div>
						<ul class="collectionsList">
							<li><a href="#">Станковая живопись</a></li>
							<li><a href="#">Монументальная живопись</a></li>
							<li><a href="#">Иконопись</a></li>
						</ul>
						<div class="collectionsBlockCount">
							23 468
						</div>
					</div>
				</div>
			<? } ?>
		</div>
	</div>
<? } ?>
