$(document).ready(function() {
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
});