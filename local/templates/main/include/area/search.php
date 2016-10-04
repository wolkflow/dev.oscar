<? use Bitrix\Main\Localization\Loc; ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<div class="modal modal-search" id="modal-search">
	<div class="modalTitle">
		Расширенный поиск
		<div class="modalClose arcticmodal-close"></div>
	</div>
	<div class="modalContent">
		<form action="" class="form">
			<ul class="formList">
				<li>
					<label for="sname">Название</label>
					<input type="text" id="sname">
				</li>
				<li>
					<label for="sauthor">Автор</label>
					<input type="text" id="sauthor">
				</li>
				<li>
					<label for="scopy">Правообладатель</label>
					<input type="text" id="scopy">
				</li>
				<li class="ci-period-li speriod">
					<label class="filtersTitle display-inlineBlock" for="speriod">Период</label>
					<label class="label-radio"><input type="radio" name="speriod" id="speriod" class="styler" checked> Год</label>
					<label class="label-radio"><input type="radio" name="speriod" class="styler"> Век</label>
					<div class="periodSelect">
						<div class="periodSelect_first">
							<input type="text" placeholder="От">
							<select class="styler">
								<option value="ДНЭ">ДО НАШЕЙ ЭРЫ</option>
								<option value="НЭ">НАШЕЙ ЭРЫ</option>
							</select>
						</div>
						<div class="periodSelect_second">
							<input type="text" placeholder="До">
							<select class="styler">
								<option value="ДНЭ">ДО НАШЕЙ ЭРЫ</option>
								<option value="НЭ">НАШЕЙ ЭРЫ</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<label for="stech">Техника</label>
					<input type="text" id="stech">
				</li>
				<li>
					<label for="sid">Техника</label>
					<input type="text" id="sid">
				</li>
				<li>
					<label for="skeywords">Ключевые слова</label>
					<input type="text" id="skeywords">
				</li>
				<li>
					<input type="submit" value="Найти" />
				</li>
			</ul>
		</form>
	</div>
</div>