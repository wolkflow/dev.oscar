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
    
    $(function() {
        var format = 'dd.mm.yy';
        
        
        
        var from = $('#js-sales-period-min-search-id')
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: format,
                })
                .on('change', function() {
                    to.datepicker('option', 'minDate', getDate(this));
                    getRemoteSales();
                });
        var to = $('#js-sales-period-max-search-id')
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: format,
                })
                .on('change', function() {
                    from.datepicker('option', 'maxDate', getDate(this));
                    getRemoteSales();
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
    $(document).on('click', '#js-sales-block-id .js-checkbox', function() {
        if ($('#js-sales-block-id .js-checkbox:checked').length > 0) {
            $('#js-sales-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-sales-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    
     $('#js-sales-block-id .js-group-action').on('click', function() {
        var action = $(this).data('action');
        var data = $('#js-sales-block-id form').objectize();
        
        if ($('#js-sales-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        
        switch (action) {
            case ('print'):
                location.href = '/screens/sales/?print=yes&' + $('#js-sales-block-id form').serialize();
                break;
                
            case ('email'):
                data['action'] = 'mail-sales-pdf';
                
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
                data['action'] = 'load-sales-pdf';
            
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