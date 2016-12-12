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
    
    $(function() {
        var format = 'dd.mm.yy';
        
        var from = $('#js-sales-objects-period-min-search-id')
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: format,
                })
                .on('change', function() {
                    to.datepicker('option', 'minDate', getDate(this));
                    getRemoteSalesObjects();
                });
        var to = $('#js-sales-objects-period-max-search-id')
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: format,
                })
                .on('change', function() {
                    from.datepicker('option', 'maxDate', getDate(this));
                    getRemoteSalesObjects();
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(format, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }
    });
    
    
    // Выбор элемента.
    $(document).on('click', '#js-sales-objects-block-id .js-checkbox', function() {
        if ($('#js-sales-objects-block-id .js-checkbox:checked').length > 0) {
            $('#js-sales-objects-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-sales-objects-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    
    // Выделение всех элементов.
    $(document).on('click', '#js-sales-objects-block-id .js-check-all', function() {
        $('#js-sales-objects-wrapper-id input.js-checkbox').prop('checked', 'checked');
        $('#js-sales-objects-wrapper-id input.js-checkbox').parent('div').addClass('checked');
        $('.js-dependence-chekbox-button').addClass('is-active');
    });
    
     $('#js-sales-objects-block-id .js-group-action').on('click', function() {
        var action = $(this).data('action');
        var data = $('#js-sales-objects-block-id form').objectize();
        
        if ($('#js-sales-objects-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        
        switch (action) {
            case ('print'):
                location.href = '/screens/stats/?print=yes&' + $('#js-sales-objects-block-id form').serialize();
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