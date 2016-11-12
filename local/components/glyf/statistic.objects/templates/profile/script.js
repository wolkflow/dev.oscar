$(document).ready(function() {
    
    $('#js-objects-search-id').on('keyup',function() {
        var title = $(this).val();
        var count = parseInt($('#js-objects-page-count-id option:selected').val());
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.objects', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-objects-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-objects-page-count-id', function() {
        var title = $('#js-objects-search-id').val();
        var count = parseInt($('#js-objects-page-count-id option:selected').val());
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.objects', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-objects-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-objects-nav-id .js-page', function() {
        var title = $('#js-objects-search-id').val();
        var count = parseInt($('#js-objects-page-count-id option:selected').val());
        var page  = parseInt($(this).data('page'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.objects', 'title': title, 'count': count, 'page': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-objects-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
    
});