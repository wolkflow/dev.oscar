function getRemoteObjects(page)
{
    var title = $('#js-objects-search-id').val();
    var count = parseInt($('#js-objects-page-count-id option:selected').val());
    var sort  = $('#js-objects-block-id .js-sort-active').data('sort');
    var page = page || 1;
    
    $.ajax({
        url: '/remote/',
        type: 'post',
        data: {'action': 'get-html', 'inc': 'user.statistic.objects', 'title': title, 'count': count, 'page': page, 'sort': sort},
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#js-objects-wrapper-id').html(response.data['html']);
            }
        }
    });
}


$(document).ready(function() {
    
    // Выбор элемента.
    $(document).on('click', '#js-objects-block-id .js-checkbox', function() {
        if ($('#js-objects-block-id .js-checkbox:checked').length > 0) {
            $('#js-objects-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-objects-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    // Выделение всех элементов.
    $(document).on('click', '#js-objects-block-id .js-check-all', function() {
        $('#js-objects-block-id input.js-checkbox').prop('checked', 'checked');
        $('#js-objects-block-id input.js-checkbox').parent('div').addClass('checked');
        $('#js-objects-block-id .js-dependence-chekbox-button').addClass('is-active');
    });
    
    
    $('#js-objects-block-id .js-group-action').on('click', function() {
        var action = $(this).data('action');
        var data = $('#js-objects-block-id form').objectize();
        
        if ($('#js-objects-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        
        switch (action) {
            case ('print'):
                location.href = '/screens/stats/?print=yes&' + $('#js-objects-block-id form').serialize();
                break;
                
            case ('email'):
                data['action'] = 'mail-stats-pdf';
                
                $.ajax({
                    url: '/remote/',
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            inform(response.message);
                        } else {
                            error(response.message);
                        }
                    }
                });
                break;
                
            case ('loadpdf'):
                data['action'] = 'load-stats-pdf';
            
                $.ajax({
                    url: '/remote/',
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            location.href = response.data['link'];
                        } else {
                            error(response.message);
                        }
                    }
                });
                break;
        }
    });
    
    
    // Поиск по названию.
    $('#js-objects-search-id').on('keyup',function() {
        getRemoteObjects();
    });
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-objects-page-count-id', function() {
        getRemoteObjects();
    });
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-objects-nav-id .js-page', function() {
        getRemoteObjects(parseInt($(this).data('page')));
    });
    
    // Сортировка.
    $(document).on('click', '#js-objects-block-id .js-sort', function() {
        $('#js-objects-block-id .js-sort').removeClass('js-sort-active');
        $(this).addClass('js-sort-active');
        
        getRemoteObjects();
    });
});