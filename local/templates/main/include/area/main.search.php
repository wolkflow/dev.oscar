<? use Bitrix\Main\Localization\Loc; ?>

<div class="top">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
				<div class="searchBlock">
					<div class="searchBlockAdd">
						<a href="javascript:void(0)" data-modal="#modal-search">
							<i class="icon icon-search-filter"></i>
						</a>
					</div>
					<div class="input-group">
						<form action="/search/">
							<input type="text" class="form-control" placeholder="<?= Loc::getMessage('GL_MAIN_SEARCH_FORM_PLACEHOLDER') ?>" />
							<span class="input-group-btn">
								<a href="javascript:void(0)" onclick="javascript: $(this).closest('form').trigger('submit');">
									<i class="icon icon-find"></i>
								</a>
							</span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

