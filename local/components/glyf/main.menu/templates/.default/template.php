<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? use Bitrix\Main\Localization\Loc; ?>
<? use Glyf\Core\Helpers\Text as TextHelper; ?>

<? IncludeComponentTemplateLangFile(__FILE__, $this->GetFolder()) ?>

<? $this->setFrameMode(true); ?>

<div class="container mainBlocks">
	<div class="row">
		<div class="col-sm-6 col-lg-3 mainBlock mainBlock-1">
			<a href="/search/">
				<div class="mainBlockTitle">
					<?= getMessage('GL_MENU_EASY_SEARCH') ?>
				</div>
				<div class="mainBlockImage"></div>
				<div class="mainBlockText">
					<?= getMessage('GL_MENU_EASY_SEARCH_TEXT') ?>
				</div>
			</a>
			<div class="mainBlockFooter">
				<span><?= $arResult['COUNT_COLLECTIONS'] ?></span>
				<?= TextHelper::decofnum(
					$arResult['COUNT_COLLECTIONS'], 
					array(getMessage('GL_COLLECTIONS_1N'), getMessage('GL_COLLECTIONS_2N'), getMessage('GL_COLLECTIONS_3N'))
				); ?>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mainBlock mainBlock-2">
			<a href="/collections/">
				<div class="mainBlockTitle">
					<?= getMessage('GL_MENU_NEW_COLLECTIONS') ?>
				</div>
				<div class="mainBlockImage"></div>
				<div class="mainBlockText">
					<?= getMessage('GL_MENU_NEW_COLLECTIONS_TEXT') ?>
				</div>
			</a>
			<div class="mainBlockFooter">
				<span><?= $arResult['COUNT_OBJECTS'] ?></span>
				<?= TextHelper::decofnum(
					$arResult['COUNT_OBJECTS'], 
					array(getMessage('GL_OBJECTS_1N'), getMessage('GL_OBJECTS_2N'), getMessage('GL_OBJECTS_3N'))
				); ?>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mainBlock mainBlock-3">
			<a href="/subscribe/">
				<div class="mainBlockTitle">
					<?= getMessage('GL_MENU_SUBSCRIBE') ?>
				</div>
				<div class="mainBlockImage"></div>
				<div class="mainBlockText">
					<?= getMessage('GL_MENU_SUBSCRIBE_TEXT') ?>
				</div>
			</a>
			<div class="mainBlockFooter">
				<span><?= $arResult['COUNT_SUBSCRIBES'] ?></span>
				<?= TextHelper::decofnum(
					$arResult['COUNT_SUBSCRIBES'], 
					array(getMessage('GL_SUBSCRIBES_1N'), getMessage('GL_SUBSCRIBES_2N'), getMessage('GL_SUBSCRIBES_3N'))
				); ?>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mainBlock mainBlock-4">
			<a href="/blog/">
				<div class="mainBlockTitle">
					<?= getMessage('GL_MENU_BLOG') ?>
				</div>
				<div class="mainBlockImage"></div>
				<div class="mainBlockText">
					<?= getMessage('GL_MENU_BLOG_TEXT') ?>
				</div>
			</a>
			<div class="mainBlockFooter">
				<span><?= $arResult['COUNT_ARTICLES'] ?></span>
				<?= TextHelper::decofnum(
					$arResult['COUNT_ARTICLES'], 
					array(getMessage('GL_ARTICLES_1N'), getMessage('GL_ARTICLES_2N'), getMessage('GL_ARTICLES_3N'))
				); ?>
			</div>
		</div>
	</div>
</div>