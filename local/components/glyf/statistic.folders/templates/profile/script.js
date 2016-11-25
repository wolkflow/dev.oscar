function cAddFolder(response)
{
    if (response.status) {
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'user.statistic.folders', 'count': $('#js-folders-page-count-id').val(), 'page': 1},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-folders-wrapper-id').html(response.data['html']);
                    $('#js-folder-title-id').val('');
                }
            }
        });
    }
}

$(document).ready(function() {
    
    // Выбор элемента.
    $(document).on('click', '#js-folders-wrapper-id .js-checkbox', function() {
        if ($('#js-folders-wrapper-id .js-checkbox:checked').length > 0) {
            $('.js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('.js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    // Выделение всех элементов.
    $(document).on('click', '#js-check-all-id', function() {
        $('#js-folders-wrapper-id input' + $(this).data('selector')).prop('checked', 'checked');
        $('#js-folders-wrapper-id input' + $(this).data('selector')).parent('div').addClass('checked');
    });
    
    
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
    
    // Удаление папок.
    $('#js-remove-folders-id').on('click', function() {
        var fids = [];
        $('#js-folders-wrapper-id .js-checkbox:checked').each(function() {
            fids.push($(this).val());
        });
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'remove-folders', 'fids': fids},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $.ajax({
                        url: '/remote/',
                        type: 'post',
                        data: {'action': 'get-html', 'inc': 'user.statistic.folders', 'count': $('#js-folders-page-count-id').val(), 'page': 1},
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#js-folders-wrapper-id').html(response.data['html']);
                            }
                        }
                    });
                } else {
                    error(response.message);
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