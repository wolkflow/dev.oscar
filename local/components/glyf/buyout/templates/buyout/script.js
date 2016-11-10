$(document).ready(function() {
    
    // Удаление товара из предварительной покупки.
    $('#js-buyout-delete-id').on('click', function() {
        var bids = [];
        
        $('#js-buyout-pictures-wrapper-id .js-buyout-picture:checked').each(function() {
            bids.push(parseInt($(this).val()));
        });
        
        if (bids.length > 0) {
            $.ajax({
                url: '/remote/',
                type: 'post',
                data: {'action': 'remove-from-cart', 'bids': bids},
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        for (var i in response.data['bids']) {
                            $('#js-cart-' + response.data['bids'][i] + '-id').remove(); 
                        }
                    }
                }
            });
        }
    });
    
    
    // Выбор товара для покупки.
    $(document).on('click', '.js-buyout-item', function() {
        var bid = $(this).data('bid');
        var pid = $(this).data('pid');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'picture.buyout', 'pid': pid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-picture-buyout-wrapper-id').html(response.data['html']); 
                }
            }
        });
    });
    
    
    // Удаление товара для покупки.
    $(document).on('click', '#js-buyout-picture-remove-id', function() {
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'picture.buyout', 'pid': 0},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-picture-buyout-wrapper-id').html(response.data['html']); 
                }
            }
        });
    });
    
    // Выбор основного типа лицензии.
    $(document).on('click', '.js-license-root', function() {
        var title = $(this).data('title');
        var lid   = $(this).val();
        var html  = '';
        
        html += '<li>';
        html += '<label>' + title + '</label>';
        html += '<select id="js-license-select-' + lid + '-id" class="styler"></select>';
        html += '</label>';
        html += '</li>';
        
        $('#js-licenses-selects-id').html(html);
    });
});

