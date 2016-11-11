$(document).ready(function() {
    
    $('#js-param-author-id').on('keyup', function() {
        var text = $(this).val();
        
        if (text.length <= 1) {
            return;
        }
        var $suggest = $('#js-suggets-author-id');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'dictionary-author-suggest', 'text': text},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $suggest.html('');
                    for (var i in response.data) {
                        item = response.data[i];
                        $suggest.append('<li data-id="' + item['ID'] + '">' + item['TITLE'] + '</li>');
                    }
                    $suggest.show();
                }
            }
        });
    });
    
    
    // Подсказка.
    $('#js-param-holder-id').on('keyup', function() {
        var text = $(this).val();
        
        if (text.length <= 1) {
            return;
        }
        var $suggest = $('#js-suggets-holder-id');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'dictionary-holder-suggest', 'text': text},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $suggest.html('');
                    for (var i in response.data) {
                        item = response.data[i];
                        $suggest.append('<li data-id="' + item['ID'] + '">' + item['TITLE'] + '</li>');
                    }
                    $suggest.show();
                }
            }
        });
    });
    
    
    // Добавление в корзину.
    $(document).on('click', '.add-to-cart', function() {
        var pid = $(this).data('pid');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'add-to-cart', 'pid': pid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-cart-count-id').html(response.data['count']);
                }
            }
        });
    });
    
    
    // Скачивание.
    $(document).on('click', '#js-download-id', function() {
        var pid = $(this).data('pid');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-download-link', 'pid': pid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    location.href = response.data['link'];
                }
            }
        });
    });
    
    
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-folder-pictures-page-count-id', function() {
        var count = parseInt($('#js-folder-pictures-page-count-id option:selected').val());
        var order = $('#js-folder-pictures-order-id .js-active-order').data('order');
        var page  = 1; // parseInt($('#js-folder-pictures-nav-id .current').text());
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
        /*
        var option = $(this).find(':selected');
        var href = $(option).data('href'); 
        
        if (href.length > 0) {
            location.href = href;
        }*/
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
    
    // Изменение сортировки.
    $(document).on('click', '.js-order', function() {
        $('#js-folder-pictures-order-id .js-order').removeClass('js-active-order');
        $(this).addClass('js-active-order');
        
        var order = $('#js-folder-pictures-order-id .js-active-order').data('order');
        var count = parseInt($('#js-folder-pictures-page-count-id option:selected').val());
        var page  = parseInt($('#js-folder-pictures-nav-id .current').text());
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