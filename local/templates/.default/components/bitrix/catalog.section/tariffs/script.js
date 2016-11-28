$(document).ready(function() {
    $(document).on('click', '.js-buy-tariff', function() {
        var tid = $(this).data('tid');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'pay-tariff', 'tid': tid},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    location.href = response.data['link'];
                } else {
                    error(response.message);
                }
            }
        });
    });
});