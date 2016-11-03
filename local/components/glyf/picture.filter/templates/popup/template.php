<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Glyf\Oscar\Picture; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="modal modal-search" id="modal-search">
	<div class="modalTitle">
		<?= getMessage('GL_FILTER_EX') ?>
		<div class="modalClose arcticmodal-close"></div>
	</div>
	<div class="modalContent">
		<form action="/search/" class="form">
			<ul class="formList">
				<li>
					<label for="sname">
                        <?= getMessage('GL_SEARCH_PARAM_TITLE') ?>
                    </label>
					<input type="text" name="F[TITLE]" value="<?= $arResult['DATA']['TITLE'] ?>" />
				</li>
				<li>
					<label for="sauthor">
                        <?= getMessage('GL_SEARCH_PARAM_AUTHOR') ?>
                    </label>
					<input type="hidden" id="js-param-author-id" name="F[AUTHOR]" value="<?= $arResult['DATA']['AUTHOR'] ?>" />
                    <input type="text" class="suggest" data-type="author" data-input="#js-param-author-id" name="F[AUTHOR_TITLE]" value="<?= $arResult['DATA']['AUTHOR_TITLE'] ?>" />
                    <ul id="js-suggets-author-id" class="hide suggest"></ul>
				</li>
				<li>
					<label for="scopy">
                        <?= getMessage('GL_SEARCH_PARAM_HOLDER') ?>
                    </label>
					<input type="hidden" id="js-param-holder-id" name="F[HOLDER]" value="<?= $arResult['DATA']['HOLDER'] ?>" />
                    <input type="text" class="suggest" data-type="holder" data-input="#js-param-holder-id" name="F[HOLDER_TITLE]" value="<?= $arResult['DATA']['HOLDER_TITLE'] ?>" />
                    <ul id="js-suggets-holder-id" class="hide suggest"></ul>
				</li>
				<li class="ci-period-li speriod">
					<label class="filtersTitle display-inlineBlock" for="speriod">
                        <?= getMessage('GL_SEARCH_PARAM_PERIOD') ?>
                    </label>
					<label class="label-radio">
                        <input type="radio" name="F[ISYEAR]" id="ci-period" value="YEAR" class="styler" <?= ($arResult['DATA']['ISYEAR'] == 'YEAR' || empty($arResult['DATA']['ISYEAR'])) ? ('checked') : ('') ?> />
                        <?= getMessage('GL_SEARCH_PARAM_YEAR') ?>
                    </label>
                    <label class="label-radio">
                        <input type="radio" name="F[ISYEAR]" class="styler" value="CENTURY" <?= ($arResult['DATA']['ISYEAR'] == 'CENTURY') ? ('checked') : ('') ?> />
                        <?= getMessage('GL_SEARCH_PARAM_CENTURY') ?>
                    </label>
					<div class="periodSelect">
						<div class="periodSelect_first">
							<input type="text" name="F[PERIOD_FROM]" value="<?= $arResult['DATA']['PERIOD_FROM'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_FROM') ?>" />
                            <select class="styler" name="F[PERIOD_FROM_ERA]">
                                <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_BC || empty($arResult['DATA']['PERIOD_FROM_ERA'])) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_BC') ?>
                                </option>
                                <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_FROM_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_AD') ?>
                                </option>
                            </select>
						</div>
						<div class="periodSelect_second">
							<input type="text" name="F[PERIOD_TO]" value="<?= $arResult['DATA']['PERIOD_TO'] ?>" placeholder="<?= getMessage('GL_SEARCH_PARAM_TO') ?>" />
                            <select class="styler" name="F[PERIOD_TO_ERA]">
                                <option value="<?= Picture::PROP_TIME_BC ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_BC || empty($arResult['DATA']['PERIOD_TO_ERA'])) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_BC') ?>
                                </option>
                                <option value="<?= Picture::PROP_TIME_AD ?>" <?= ($arResult['DATA']['PERIOD_TO_ERA'] == Picture::PROP_TIME_AD) ? ('selected') : ('') ?>>
                                    <?= getMessage('GL_SEARCH_PARAM_AD') ?>
                                </option>
                            </select>
						</div>
					</div>
				</li>
				<li>
					<label for="stech">
                        <?= getMessage('GL_SEARCH_PARAM_TECHNIQUE') ?>
                    </label>
					<input type="hidden" id="js-param-technique-id" name="F[TECHNIQUE]" value="<?= $arResult['DATA']['TECHNIQUE'] ?>" />
                    <input type="text" class="suggest" data-type="technique" data-input="#js-param-technique-id" name="F[TECHNIQUE_TITLE]" value="<?= $arResult['DATA']['TECHNIQUE_TITLE'] ?>" />
                    <ul id="js-suggets-technique-id" class="hide suggest"></ul>
				</li>
				<li>
					<label for="sid">
                        <?= getMessage('GL_SEARCH_PARAM_ID') ?>
                    </label>
					<input type="text" id="ci-right_id" name="F[ID]" value="<?= $arResult['DATA']['ID'] ?>" />
				</li>
				<li>
					<label for="skeywords">
                        <?= getMessage('GL_SEARCH_PARAM_KEYWORDS') ?>
                    </label>
					<input type="text" id="ci-right_keywords" name="F[KEYWORDS]" value="<?= $arResult['DATA']['KEYWORDS'] ?>" />
				</li>
				<li>
					<input type="submit" value="<?= getMessage('GL_SEARCH_BUTTON_SUBMIT') ?>" />
				</li>
			</ul>
		</form>
	</div>
</div>