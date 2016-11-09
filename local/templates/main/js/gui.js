$(document).ready(function() {
    $('#js-param-place-country-id').on('keydown', function(event) {
        $('#js-param-country-id').val('');
        $('#js-param-city-id').val('');
        $('#js-param-place-city-id').val('');
    }).autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-city-id').on('keydown', function(event) {
        $('#js-param-city-id').val('');
    }).autocomplete({
        change: function(event, ui) {
            $('#js-param-city-id').val('');
        },
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term, 'country': parseInt($('#js-param-country-id').val())},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-country-id').on('keydown', function(event) {
        $('#js-param-country-id').val('');
        $('#js-param-city-id').val('');
    }).autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('#js-param-place-city-id').on('keydown', function(event) {
        $('#js-param-city-id').val('');
    }).autocomplete({
        change: function(event, ui) {
            $('#js-param-city-id').val('');
        },
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term, 'country': parseInt($('#js-param-country-id').val())},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    $('.suggest').autocomplete({
        source: function(request, callback) {
            var $item = $(this.element[0]);
            
            $.ajax({
                url: '/remote/',
                dataType: 'json',
                data: {'action': 'dictionary-' + $item.data('type') + '-suggest', 'text': request.term},
                success: function(response) {
                    if (response.status) {
                        callback(response.data);
                    }
                }
            });
        },
        select: function(event, ui) {
            $($(this).data('input')).val(ui.item.id);
        },
        minLength: 2
    });
    
    
    
    // Добавление в корзину.
    $(document).on('click', '.js-add-to-cart', function() {
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