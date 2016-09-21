$(document).ready(function () {
	$(function () {
		var pull = $('#pull'),
		menu = $('#navbar'),
		menuParent = $('.menu'),
		menuHeight = menu.height();

		$(pull).on('click', function (e) {
			e.preventDefault();
			menu.slideToggle();
			menuParent.toggleClass('in')
		});

		$(window).resize(function () {
			var w = $(window).width();
			if (w > 767 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	});

	$('[data-collapse-target]').on('click', function(){
		var target = $('[data-collapse-block='+$(this).data('collapse-target')+']');
		$(this).toggleClass('is-expanded');
		$(target).slideToggle(300, function(){
			$(target).toggleClass('collapsed')
		});

		return false;
	});

	$('.cabinet-panel__toggler').on('click', function(){
		$(this).toggleClass('is-expanded').closest('.cabinet-block').toggleClass('is-expanded');
	});

	$('.cabinet-panel__switch span').on('click', function(){
		var $self = $(this);

		$self.siblings().each(function(){
			$('.cabinet-block-' + $(this).data('block')).removeClass('is-active');
		});

		$('.cabinet-block-' + $self.data('block')).addClass('is-active');
	});

	$('[data-modal]').click(function() {
		var modal = $(this).data('modal');
		$(modal).arcticmodal();
		return false;
	});

	function setEqualHeight(columns)
	{
		var tallestcolumn = 0;
		columns.each(
			function()
			{
				currentHeight = $(this).height();
				if(currentHeight > tallestcolumn)
				{
					tallestcolumn = currentHeight;
				}
			}
		);
		columns.height(tallestcolumn);
	}
	setEqualHeight($(".subscribeCol-list"));
	setEqualHeight($(".subscribeSearch-col"));

});