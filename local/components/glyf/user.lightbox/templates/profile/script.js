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
    $(document).on('click', '.js-picture-item-checkbox', function() {
        if ($('.js-picture-item-checkbox:checked').length > 0) {
            $('.js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('.js-dependence-chekbox-button').removeClass('is-active');
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
                    console.log(response.data['pids']);
                }
            }
        });
    });
    
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-folder-pictures-nav-id .js-page', function() {
        var count = parseInt($('#js-folder-pictures-page-count-id option:selected').val());
        var order = $('#js-folder-pictures-order-id .js-active-order').data('order');
        var page  = parseInt($(this).data('page'));
        var fid   = parseInt($('#js-folder-pictures-wrapper-id').data('fid'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.folder', 'fid': fid, 'count': count, 'page': page, 'order': order},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-folder-pictures-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
});