
// Добавление изображение в сборник.
function addPictureToLignhbox(pid, lid, tpl)
{
    pid = parseInt(pid);
    lid = parseInt(lid);
    
    $.ajax({
        url: '/remote/',
        type: 'post',
        dataType: 'json',
        data: {'action': 'add-to-lightbox', 'pid': pid, 'lid': lid},
        success: function(response) {
            if (response.status) {
                $.ajax({
                    url: '/remote/',
                    type: 'post',
                    data: {'action': 'get-html', 'inc': 'lightbox.block', 'pid': pid, 'lid': lid, 'tpl': tpl},
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            $('#js-side-lightbox-' + lid + '-id .js-lightbox-content').html(response.data['html']);
                        } else {
                            error(response.message);
                        }
                    }
                });
            } else {
                error(response.message);
            }
        }
    });
}


$(document).ready(function() {
    
    $(document).on('click', '.js-add-to-lightbox', function() {
        var $lightbox = $('.js-acitve-lightbox');
        
        addPictureToLignhbox($(this).data('pid'), $lightbox.data('lid'), 'side');
    });
    
    
    $('#js-param-place-country-id').on('keydown', function(event) {
        $('#js-param-country-id').val('');
        $('#js-param-city-id').val('');
        $('#js-param-place-city-id').val('');
    }).autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-city-id').on('keydown', function(event) {
        $('#js-param-city-id').val('');
    }).autocomplete({
        change: function(event, ui) {
            $('#js-param-city-id').val('');
        },
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term, 'country': parseInt($('#js-param-country-id').val())},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-country-id').on('keydown', function(event) {
        $('#js-param-country-id').val('');
        $('#js-param-city-id').val('');
    }).autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-city-id').on('keydown', function(event) {
        $('#js-param-city-id').val('');
    }).autocomplete({
        change: function(event, ui) {
            $('#js-param-city-id').val('');
        },
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term, 'country': parseInt($('#js-param-country-id').val())},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('.suggest').autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    
    // Добавление в корзину.
    $(document).on('click', '.js-add-to-cart', function() {
        var pid = $(this).data('pid');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'add-to-cart', 'pid': pid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-cart-count-id').html(response.data['count']);
                } else {
                    error(response.message);
                }
            }
        });
    });
    
    // Перетаскивание объекта в сборник.
    $('.js-picture-drag').draggable({
		revert: 'invalid',
		helper: 'clone',
		cursor: 'move',
		cursorAt: { top: 35, left: 35 }
	});
    
    // Перетаскивание объекта в сборник.
    $('.js-lightbox-drop').droppable({
		drop: function(event, ui) {
            var $that = $(this);
            var $item = ui.draggable;
            
            $that.addClass('newItemAdded');
			addPictureToLignhbox($item.data('pid'), $that.data('lid'), 'side');
		}
	});

    // Перетаскивание объекта в сборник.
    /*
	$('.lightboxes__item').droppable({
		drop: function(event, ui) {
            var $that = $(this);
            var $item = ui.draggable;

            $that.addClass('newItemAdded');
			addPictureToLignhbox($item.data('pid'), $that.data('lid'), 'side');
		}
	});
    */
});