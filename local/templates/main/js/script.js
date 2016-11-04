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

	$('.ddparent').on('click', function () {
		$(this).toggleClass('active').next('ul').slideToggle();
	});
	$(document).on('click', '.uploadError-close', function() {
		$('.uploadError').hide();
	});

	$('.requestEdit-save, .requestEdit-delete').on('click', function(){
		$(this).parent().hide();
		return false;
	});
	$('.btn-filter_edit').on('click', function(){
		$('.requestTitle').toggleClass('edit');
		return false;
	});
	$(document).on('click', '.requestTitle', function(){
		if($(this).hasClass('edit')) {
			var dtext = $(this).text();
			$(this).next().show();
			$(this).next().find('input').val(dtext)
			return false;
		} else {
			return false;
		}
	});

	$('.js-contacts_submit').on('click', function () {
		$(this).parents('form').submit();
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
    
    
    $('[data-modal]').click(function() {
		var modal = $(this).data('modal');
		$(modal).arcticmodal();
		return false;
	});

	// Больше параметров
	$(document).on('click', '.btn-more_params', function () {
		if($(this).hasClass('open')) {
			$(this).removeClass('open').text('Еще');
			$(this).parent('.filterBlock').find('.moreParamsList').slideUp();
		} else {
			$(this).addClass('open').text('Скрыть');
			$(this).parent('.filterBlock').find('.moreParamsList').slideDown();
		}
		return false;
	});

	// LiveEdit

	$('a.le-start').on('click', function(){
		var le = $(this).data('le');
		$('[data-le="'+le+'"]').removeClass('disabled');
		$('input[data-le="'+le+'"]').each(function () {
			var leVal = $(this).val();
			$(this).prop('disabled', false).attr('placeholder', leVal).removeClass('disabled');
		});
		$(this).closest('div').find('.le-start').addClass('disabled');
		$(this).closest('div').find('.le-end').removeClass('disabled').attr('data-le', le);

		return false;
	});
	$('a.le-end').on('click', function(){
		var le = $(this).attr('data-le');

		$('[data-le="'+le+'"]').addClass('disabled');
		if($(this).hasClass('le-cancel')) {
			$('input[data-le="'+le+'"]').each(function () {
				var leVal = $(this).attr('placeholder');
				$(this).prop('disabled', true).addClass('disabled').val(leVal);
			});
		} else {
			$('input[data-le="'+le+'"]').each(function () {
				$(this).prop('disabled', true).addClass('disabled');
			});
		}
		$(this).closest('div').find('.le-start').removeClass('disabled');
		$(this).closest('div').find('.le-end').addClass('disabled');

		return false;
	});

});


/*
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
*/