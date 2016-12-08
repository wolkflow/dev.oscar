$(document).ready(function() {
    
    // Выбор элемента.
    $(document).on('click', '#js-orders-block-id .js-checkbox', function() {
        if ($('#js-orders-wrapper-id .js-checkbox:checked').length > 0) {
            $('#js-orders-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-orders-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-orders-page-count-id', function() {
        var count = parseInt($('#js-orders-page-count-id option:selected').val());
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.orders', 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-orders-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-orders-nav-id .js-page', function() {
        var count = parseInt($('#js-orders-page-count-id option:selected').val());
        var page  = parseInt($(this).data('page'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.orders', 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-orders-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
});