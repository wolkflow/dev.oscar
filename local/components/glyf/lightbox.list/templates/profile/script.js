$(document).ready(function() {
    $('#js-personal-lightbox-delete-id').on('click', function() {
        var lids = [];
        
        $('.js-personal-lightbox:checked').each(function() {
            lids.push($(this).val());
        });
        
        if (lids.length > 0) {
            $.ajax({
                url: '/remote/',
                type: 'post',
                data: {'action': 'lighboxes-delete', 'lids': lids},
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        console.log(response);
                        
                        $('.js-personal-lightbox:checked').each(function() {
                            $(this).closest('.js-lightbox-wrap').fadeOut({'duration': 150});
                        });
                    }
                }
            });
        }
    });
});