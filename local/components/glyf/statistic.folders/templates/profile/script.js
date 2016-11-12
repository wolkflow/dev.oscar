$(document).ready(function() {
    
    $('#js-folders-search-id').on('keyup',function() {
        var title = $(this).val();
        var count = parseInt($('#js-folders-page-count-id option:selected').val());
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.folders', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-folders-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-folders-page-count-id', function() {
        var title = $('#js-folders-search-id').val();
        var count = parseInt($('#js-folders-page-count-id option:selected').val());
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.folders', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-folders-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-folders-nav-id .js-page', function() {
        var title = $('#js-folders-search-id').val();
        var count = parseInt($('#js-folders-page-count-id option:selected').val());
        var page  = parseInt($(this).data('page'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.folders', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-folders-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
});