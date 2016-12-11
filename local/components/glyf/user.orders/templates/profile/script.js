$(document).ready(function() {
    /*
    $(document).on('click', '#js-orders-block-id .js-button-print', function() {
        if ($('#js-orders-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        var query = $('#js-orders-block-id form').serialize();
        
        location.href = '/screens/orders/?print=yes&' + query;
    });
    */
    // Выбор элемента.
    $(document).on('click', '#js-orders-block-id .js-checkbox', function() {
        if ($('#js-orders-wrapper-id .js-checkbox:checked').length > 0) {
            $('#js-orders-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-orders-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    $('#js-orders-block-id .js-group-action').on('click', function() {
        var action = $(this).data('action');
        
        if ($('#js-orders-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        var ids = $('#js-orders-block-id form').objectize();
        
        console.log(ids);
        return;
        switch (action) {
            case ('print'):
                location.href = '/screens/orders/?print=yes&' + $('#js-orders-block-id form').serialize();
                break;
                
            case ('email'):
                $.ajax({
                    url: '/remote/',
                    type: 'post',
                    data: {'action': 'mail-user-orders-pdf', 'ids': ids},
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            error(response.data['title'], response.data['message']);
                        }
                    }
                });
                break;
                
            case ('loadpdf'):
                $.ajax({
                    url: '/remote/',
                    type: 'post',
                    data: {'action': 'load-user-orders-pdf', 'ids': ids},
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            error(response.data['title'], response.data['message']);
                        }
                    }
                });
                break;
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