function getRemoteSalesObjects(page)
{
    var title = $('#js-sales-objects-search-id').val();
    var count = parseInt($('#js-sales-objects-page-count-id option:selected').val());
    var prmin = $('#js-sales-objects-period-min-search-id').val();
    var prmax = $('#js-sales-objects-period-max-search-id').val();
    var sort  = $('#js-sales-objects-block-id .js-sort-active').data('sort');
    var page = page || 1;
    
    $.ajax({
        url: '/remote/',
        type: 'post',
        data: {'action': 'get-html', 'inc': 'user.statistic.sales.objects', 'title': title, 'count': count, 'page': page, 'prmin': prmin, 'prmax': prmax, 'sort': sort},
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#js-sales-objects-wrapper-id').html(response.data['html']);
            }
        }
    });
}

$(document).ready(function() {
    
    // Выбор элемента.
    $(document).on('click', '#js-sales-objects-wrapper-id .js-checkbox', function() {
        if ($('#js-sales-objects-wrapper-id .js-checkbox:checked').length > 0) {
            $('.js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('.js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    // Выделение всех элементов.
    $(document).on('click', '#js-sales-objects-block-id .js-check-all', function() {
        $('#js-sales-objects-wrapper-id input.js-checkbox').prop('checked', 'checked');
        $('#js-sales-objects-wrapper-id input.js-checkbox').parent('div').addClass('checked');
        $('.js-dependence-chekbox-button').addClass('is-active');
    });
    
    // Поиск по названию.
    $('#js-sales-objects-search-id').on('keyup',function() {
        getRemoteSalesObjects();
    });
    
    // Изменение колчиества страниц.
    $(document).on('change', '#js-sales-objects-page-count-id', function() {
        getRemoteSalesObjects();
    });
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-sales-objects-nav-id .js-page', function() {
        getRemoteSalesObjects(parseInt($(this).data('page')));
    });
    
    // Сортировка.
    $(document).on('click', '#js-sales-objects-block-id .js-sort', function() {
        $('#js-sales-objects-block-id .js-sort').removeClass('js-sort-active');
        $(this).addClass('js-sort-active');
        
        getRemoteSalesObjects();
    });
});