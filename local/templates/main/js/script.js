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



// Фкниция вызова ошибки.
function error(title, text)
{
    $('#js-error-popup-title-id').html(title);
    $('#js-error-popup-text-id').html(text);
    
    $('#error').arcticmodal();
}

// Фкниция вызова окна информации.
function inform(title, text)
{
    $('#js-inform-popup-title-id').html(title);
    $('#js-inform-popup-text-id').html(text);
    
    $('#inform').arcticmodal();
}


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
		if(!$(this).hasClass('is-expanded')) {
			var target = $('[data-collapse-block='+$(this).data('collapse-target')+']');
			$(this).parents('.col-lg-2').find($('[data-collapse-target]')).removeClass('is-expanded');
			$(this).parents('.col-lg-2').find($('[data-collapse-block]')).slideUp(200);
			$(this).addClass('is-expanded');
			$(target).stop().slideDown(200, function(){
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

	$('.cabinet-panel__switch span').on('click', function() {
		var $self = $(this);
        
		$self.siblings().each(function() {
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
    
    /*
	$('.js-contacts_submit').on('click', function () {
		$(this).parents('form').submit();
	});
    */
    
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

	$(document).on('click', 'a.le-start', function() {
		var le = $(this).data('le');
		$('[data-le="' + le + '"]').removeClass('disabled');
        $('[data-link="' + le + '"]').removeClass('hidden');
		$('input[data-le="' + le + '"]').each(function () {
			var value = $(this).val();
            
			$(this).prop('disabled', false).removeClass('disabled');
			if(value.length > 0) {
				$(this).attr('placeholder', value)
			}
		});
		$(this).closest('div').find('.le-start').addClass('disabled');
		$(this).closest('div').find('.le-end').removeClass('disabled').attr('data-le', le);
		if (le == 'email') {
			$('.le-save').attr('data-action', 'update-user-email')
		} else if (le == 'password') {
			$('.le-save').attr('data-action', 'update-user-password')
		} else if (le == 'addfolder') {
			$('body').addClass('le-active');
		}

		return false;
	});
    
    $(document).on('click', 'a.le-end', function() {
        var $that = $(this);
		var le = $that.attr('data-le');
	    $('body').removeClass('le-active');

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
            var data = {'action': $that.attr('data-action')};
            var callback = $that.data('callback');
            
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
                        
                        // Вывод ошибки.
                        error(response.message);
                        
                        $('input[data-le="' + le + '"]').each(function () {
                            if ($(this).hasClass('removable') && $(this).val().length == 0) {
                                $(this).remove();
                            }
                        });
                    }
                    
                    if (callback && typeof window[callback] == 'function') {
                        window[callback](response);
                    }
                }
            });
		}
        
		$(this).closest('div').find('.le-start').removeClass('disabled');
		$(this).closest('div').find('.le-end').addClass('disabled');

		return false;
	});


	$(document).on('click', '.le-lightbox-trigger', function(){
		if($(this).hasClass('active')) {
			$('.le-lightbox-edit').each(function(){
				var $this = $(this);
				$this.find('.le-cancel').trigger('click');
			});
			$(this).removeClass('active').text('Переименовать');
		} else {
			$('.le-lightbox-edit').each(function(){
				var $this = $(this);
				var $chk = $this.find('input[type=checkbox]');

				if($chk.prop('checked')) {
					$this.find('.le-start').trigger('click');
				}
			});
			$(this).addClass('active').text('Отмена')
		}
		return false;
	})


    $(document).mouseup(function (e) {
        if ($('body').hasClass('le-active')) {
	        var container = $('.le-new-folder');
	        if (container.has(e.target).length === 0) {
		        container.find('.le-cancel').click();
	        }
        }
    });

	$('.card-image__container > img, .lightboxes-setImage > img').draggable({
		revert: 'invalid',
		helper: 'clone',
		cursor: "move",
		cursorAt: { top: 35, left: 35}
	});
    
	$(".lightboxes__item").droppable({
		drop:function(event, ui) {
            var $that = $(this);
            var $item = ui.draggable;
            
            $that.addClass('newItemAdded');
			addPictureToLignhbox($item.data('pid'), $that.data('lid'), 'side');
		}
	});
    
    $('.styler, /*input[type="checkbox"],*/ .form input').styler();
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