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
        var step  = $(this).data('step');
        var lid   = $(this).val();
        var html  = '';
        var items = [];
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-licenses', 'lid': lid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    items.push('<option> - </option>');
                    
                    for (var i in response.data['items']) {
                        var element  = response.data['items'][i];
                        var itemhtml = '';
                        
                        itemhtml += '<option class="js-license-option" data-step="' + element['step'] + '" data-price="' + element['price'] + '" value="' + element['id'] + '">';
                        itemhtml += element['title'];
                        itemhtml += '</option>';
                        
                        items.push(itemhtml);
                    } 
                    
                    html += '<li class="js-license-wrapper">';
                    html += '<label>' + step + '</label>';
                    html += '<select class="styler js-license-select" data-lid="' + lid + '">';
                    html += items.join();
                    html += '</select>';
                    html += '</label>';
                    html += '</li>';
                    
                    $('#js-licenses-selects-id').html(html);
                }
            }
        });
    });
    
    
    
    // Выбор подтипа лицензии.
    $(document).on('change', '.js-license-select', function() {
        var $that    = $(this);
        var $option  = $that.find('option:selected');
        var $wrapper = $(this).closest('.js-license-wrapper');
        
        var step  = $option.data('step');
        var root  = $that.data('lid');
        var lid   = parseInt($that.val());
        var html  = '';
        var items = [];
        var price = parseFloat($that.data('price'));
        
        if (price > 0) {
            $('#js-buyout-price-id').html(price);
            $('#js-buyout-price-wrap-id').removeClass('hide');
            $('#js-buyout-submit-id').removeClass('hide');
        } else {
            $('#js-buyout-price-wrap-id').addClass('hide');
            $('#js-buyout-submit-id').addClass('hide');
        }
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-licenses', 'lid': lid},
            dataType: 'json',
            beforeSend: function() {
                $('.js-license-wrapper:gt(' + $('.js-license-wrapper').index($wrapper.get(0)) + ')').remove();
            },
            success: function(response) {
                if (response.status) {
                    items.push('<option> - </option>');
                    
                    for (var i in response.data['items']) {
                        var element  = response.data['items'][i];
                        var itemhtml = '';
                        
                        itemhtml += '<option data-step="' + element['step'] + '" data-price="' + element['price'] + '" value="' + element['id'] + '">';
                        itemhtml += element['title'];
                        itemhtml += '</option>';
                        
                        items.push(itemhtml);
                    } 
                    
                    html += '<li class="js-license-wrapper">';
                    html += '<label>' + step + '</label>';
                    html += '<select class="styler js-license-select" data-lid="' + lid + '">';
                    html += items.join();
                    html += '</select>';
                    html += '</label>';
                    html += '</li>';
                    
                    $('#js-licenses-selects-id').append(html);
                }
            }
        });
    });
});

