(function($){
	$.fn.objectize = function(){
		var self = this,
			json = {},
			push_counters = {},
			patterns = {
				"validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
				"key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
				"push":     /^$/,
				"fixed":    /^\d+$/,
				"named":    /^[a-zA-Z0-9_]+$/
			};
		
		this.build = function(base, key, value) {
			base[key] = value;
			return base;
		};
 
		this.push_counter = function(key) {
			if (push_counters[key] === undefined) {
				push_counters[key] = 0;
			}
			return push_counters[key]++;
		};
 
		$.each($(this).serializeArray(), function() {
			if (!patterns.validate.test(this.name)) {
				return;
			}
			var k,
				keys = this.name.match(patterns.key),
				merge = this.value,
				reverse_key = this.name;
 
			while ((k = keys.pop()) !== undefined) {
				reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');
 
				if (k.match(patterns.push)) {
					merge = self.build([], self.push_counter(reverse_key), merge);
				} else if(k.match(patterns.fixed)) {
					merge = self.build([], k, merge);
				} else if(k.match(patterns.named)) {
					merge = self.build({}, k, merge);
				}
			}
			json = $.extend(true, json, merge);
		});
		return json;
	};
})(jQuery);


$(document).ready(function () {
    
    // Фкниция вызова ошибки.
    function error(title, text)
    {
        $('#js-error-popup-title-id').html(title);
        $('#js-error-popup-text-id').html(text);
        
        $('#error').arcticmodal();
    }
    
    
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
		if(!$(this).hasClass('is-expanded')) {
			var target = $('[data-collapse-block='+$(this).data('collapse-target')+']');
			$('[data-collapse-target]').removeClass('is-expanded');
			$('[data-collapse-block]').slideUp(200);
			$(this).addClass('is-expanded');
			$(target).slideDown(200, function(){
				$(target).removeClass('collapsed');
			});
			$('.js-acitve-lightbox').removeClass('js-acitve-lightbox');
			$(this).parent().addClass('js-acitve-lightbox')
			return false;
		}
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
    
	//$('.btn-filter_edit').on('click', function(){
		//$('.requestTitle').toggleClass('edit');
		//return false;
	//});
    
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
    
    
	// Live Edit

	$('a.le-start').on('click', function(){
		var le = $(this).data('le');
		$('[data-le="' + le + '"]').removeClass('disabled');
        $('[data-link="' + le + '"]').removeClass('hidden');
		$('input[data-le="' + le + '"]').each(function () {
			var value = $(this).val();
            
			$(this).prop('disabled', false).attr('placeholder', value).removeClass('disabled');
		});
		$(this).closest('div').find('.le-start').addClass('disabled');
		$(this).closest('div').find('.le-end').removeClass('disabled').attr('data-le', le);

		return false;
	});
    
	$('a.le-end').on('click', function() {
        var $that = $(this);
		var le = $that.attr('data-le');

		$('[data-le="' + le + '"]').addClass('disabled');
        $('[data-link="' + le + '"]').addClass('hidden');
        
		if ($that.hasClass('le-cancel')) {
			$('input[data-le="' + le + '"]').each(function () {
				var value = $(this).attr('placeholder');
                
				$(this).prop('disabled', true).addClass('disabled').val(value);
                
                if ($(this).hasClass('removable') && $(this).val().length == 0 && $(this).prop('placeholder').length == 0) {
                    $(this).remove();
                }
			});
		} else {
            var data = {'action': $that.data('action')};
            
			$('input[data-le="' + le + '"]').each(function () {
                data[$(this).prop('name')] = $(this).val();
				$(this).prop('disabled', true).addClass('disabled');
			});
            
            $.ajax({
                url: '/remote/',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (!response.status) {
                        $('input[data-le="' + le + '"]').each(function () {
                            $(this).prop('disabled', true).addClass('disabled').val($(this).attr('placeholder'));
                        });
                        // show error popup
                        
                        $('input[data-le="' + le + '"]').each(function () {
                            if ($(this).hasClass('removable') && $(this).val().length == 0) {
                                $(this).remove();
                            }
                        });
                    }
                }
            });
		}
        
       
        
		$(this).closest('div').find('.le-start').removeClass('disabled');
		$(this).closest('div').find('.le-end').addClass('disabled');

		return false;
	});

	$('.card-image__container > img, .lightboxes-setImage > img').draggable({
		revert: 'invalid',
		helper: 'clone',
		cursor: "move",
		cursorAt: { top: 35, left: 35}
	});
	$(".lightboxes__item").droppable({
		drop:function(event, ui){
			$(this).addClass("newItemAdded");
			console.log('Элемент попал в коллекцию')
		}
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