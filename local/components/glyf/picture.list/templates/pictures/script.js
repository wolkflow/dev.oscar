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
});