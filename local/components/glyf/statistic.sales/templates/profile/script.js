function getRemoteSales(page)
{
    var title = $('#js-sales-search-id').val();
    var count = parseInt($('#js-sales-page-count-id option:selected').val());
    var prmin = $('#js-sales-period-min-search-id').val();
    var prmax = $('#js-sales-period-max-search-id').val();
    var sort  = $('#js-sales-block-id .js-sort-active').data('sort');
    var page = page || 1;
    
    $.ajax({
        url: '/remote/',
        type: 'post',
        data: {'action': 'get-html', 'inc': 'user.statistic.sales', 'title': title, 'count': count, 'page': page, 'prmin': prmin, 'prmax': prmax, 'sort': sort},
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#js-sales-wrapper-id').html(response.data['html']);
            }
        }
    });
}

$(document).ready(function() {
    
    // Выбор элемента.
    $(document).on('click', '#js-sales-wrapper-id .js-checkbox', function() {
        if ($('#js-sales-wrapper-id .js-checkbox:checked').length > 0) {
            $('.js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('.js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    // Выделение всех элементов.
    $(document).on('click', '#js-sales-block-id .js-check-all', function() {
        $('#js-sales-wrapper-id input.js-checkbox').prop('checked', 'checked');
        $('#js-sales-wrapper-id input.js-checkbox').parent('div').addClass('checked');
        $('.js-dependence-chekbox-button').addClass('is-active');
    });
    
    // Поиск по названию.
    $('#js-sales-search-id').on('keyup',function() {
        /*
        var title = $(this).val();
        var count = parseInt($('#js-sales-page-count-id option:selected').val());
        var prmin = $('#js-sales-period-min-search-id').val();
        var prmax = $('#js-sales-period-max-search-id').val();
        var sort  = $('#js-sales-block-id .js-sort-active').data('sort');
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.sales', 'title': title, 'count': count, 'page': page, 'prmin': prmin, 'prmax': prmax, 'sort': sort},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-sales-wrapper-id').html(response.data['html']);
                }
            }
        });
        */
        getRemoteSales();
    });
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-sales-page-count-id', function() {
        /*
        var title = $('#js-objects-search-id').val();
        var count = parseInt($('#js-sales-page-count-id option:selected').val());
        var prmin = $('#js-sales-period-min-search-id').val();
        var prmax = $('#js-sales-period-max-search-id').val();
        var sort  = $('#js-sales-block-id .js-sort-active').data('sort');
        var page  = 1;
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.sales', 'title': title, 'count': count, 'page': page, 'prmin': prmin, 'prmax': prmax, 'sort': sort},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-sales-wrapper-id').html(response.data['html']);
                }
            }
        });
        */
        getRemoteSales();
    });
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-sales-nav-id .js-page', function() {
        /*
        var title = $('#js-sales-search-id').val();
        var count = parseInt($('#js-sales-page-count-id option:selected').val());
        var prmin = $('#js-sales-period-min-search-id').val();
        var prmax = $('#js-sales-period-max-search-id').val();
        var sort  = $('#js-sales-block-id .js-sort-active').data('sort');
        var page  = parseInt($(this).data('page'));
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.sales', 'title': title, 'count': count, 'page': page, 'prmin': prmin, 'prmax': prmax, 'sort': sort},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-sales-wrapper-id').html(response.data['html']);
                }
            }
        });
        */
        getRemoteSales(parseInt($(this).data('page')));
    });
    
    // Сортировка.
    $(document).on('click', '#js-sales-block-id .js-sort', function() {
        $('#js-sales-block-id .js-sort').removeClass('js-sort-active');
        $(this).addClass('js-sort-active');
        
        getRemoteSales();
    });
});