<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<? use Glyf\Oscar\Collection; ?>

<? if (!empty($arResult['ROOT']['CHILDREN'])) { ?>
	<div class="container">
		<div class="row">
			<? foreach ($arResult['ROOT']['CHILDREN'] as $section) { ?>
                <? $collection = new Collection($section['ID']) ?>
				<div class="col-sm-4 col-md-2">
					<div class="collectionsBlock">
						<div class="collectionsBlockTitle">
							<?= $section['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
						</div>
						<div class="collectionsBlockImage">
							<img src="/i.php?src=<?= $section['PICTURE']['SRC'] ?>&w=169&h=44" />
						</div>
                        <? if (!empty($section['CHILDREN'])) { ?>
                            <ul class="collectionsList">
                                <? foreach ($section['CHILDREN'] as $subsection) { ?>
                                    <li>
                                        <a href="<?= $subsection['SECTION_PAGE_URL'] ?>">
                                            <?= $subsection['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                                        </a>
                                        <? if (!empty($subsection['CHILDREN'])) { ?>
                                            <ul>
                                                <? foreach ($subsection['CHILDREN'] as $subsubsection) { ?>
                                                    <li>
                                                        <a href="<?= $subsubsection['SECTION_PAGE_URL'] ?>">
                                                            <?= $subsubsection['UF_LANG_TITLE_'.CURRENT_LANG_UP] ?>
                                                        </a>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                        <? } ?>
                                    </li>
                                <? } ?>
                            </ul>
                        <? } ?>
						<div class="collectionsBlockCount">
							<?= number_format($collection->getPicturesCount(), 0, '.', ' ') ?>
						</div>
					</div>
				</div>
			<? } ?>
		</div>
	</div>
<? } ?>
