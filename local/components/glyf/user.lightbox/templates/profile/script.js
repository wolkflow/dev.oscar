$(document).ready(function() {
    
    
    // Добавление в корзину.
    $(document).on('click', '#js-add-list-to-cart-id', function() {
        var pids = [];
        
        $('.js-picture-item-checkbox:checked').each(function() {
            pids.push($(this).val());
        });
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'add-to-cart', 'pid': pids},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-cart-count-id').html(response.data['count']);
                }
            }
        });
    });
    
    
    // Выбор элемента.
    $(document).on('click', '#js-user-lightbox-block-id .js-checkbox', function() {
        if ($('#js-user-lightbox-block-id .js-checkbox:checked').length > 0) {
            $('#js-user-lightbox-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-user-lightbox-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    
    // Удаление картины из сборника.
    $(document).on('click', '#js-remove-list-from-lightbox-id', function() {
        var lid  = $(this).data('lid');
        var pids = [];
        
        $('.js-picture-item-checkbox:checked').each(function() {
            pids.push($(this).val());
        });
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'remove-from-lightbox', 'lid': lid, 'pid': pids},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Обновление общего контейнер.
                    $.ajax({
                        url: '/remote/',
                        type: 'post',
                        data: {'action': 'get-html', 'inc': 'user.lightbox', 'lid': lid, 'page': 1},
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#js-lightbox-pictures-wrapper-id').html(response.data['html']);
                            }
                        }
                    });
                    
                    // Обновление контейнера сборника.
                    $.ajax({
                        url: '/remote/',
                        type: 'post',
                        data: {'action': 'get-html', 'inc': 'lightbox.block', 'lid': lid},
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#js-side-lightbox-' + lid + '-id .js-lightbox-content').html(response.data['html']);
                            }
                        }
                    });
                }
            }
        });
    });
    
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-lightbox-pictures-nav-id .js-page', function() {
        var page  = parseInt($(this).data('page'));
        var lid   = parseInt($('#js-lightbox-pictures-wrapper-id').data('lid'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.lightbox', 'lid': lid, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-lightbox-pictures-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
});