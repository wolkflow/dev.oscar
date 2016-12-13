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
    $(document).on('click', '#js-folders-block-id .js-checkbox', function() {
        if ($('#js-folders-block-id .js-checkbox:checked').length > 0) {
            $('#js-folders-block-id .js-dependence-chekbox-button').addClass('is-active');
        } else {
            $('#js-folders-block-id .js-dependence-chekbox-button').removeClass('is-active');
        }
    });
    
    
    $('#js-folders-block-id .js-group-action').on('click', function() {
        var action = $(this).data('action');
        var data = $('#js-folders-block-id form').objectize();
        
        if ($('#js-folders-block-id .js-checkbox:checked').length == 0) {
            return;
        }
        
        switch (action) {
            case ('print'):
                location.href = '/screens/pictures/?print=yes&' + $('#js-folders-block-id form').serialize();
                break;
                
            case ('email'):
                data['action'] = 'mail-folders-pdf';
                
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
                data['action'] = 'load-folders-pdf';
            
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
    $(document).on('click', '#js-folders-block-id .js-check-all', function() {
        $('#js-folders-block-id input' + $(this).data('selector')).prop('checked', 'checked');
        $('#js-folders-block-id input' + $(this).data('selector')).parent('div').addClass('checked');
        $('#js-folders-block-id .js-dependence-chekbox-button').addClass('is-active');
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