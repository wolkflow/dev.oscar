$(document).ready(function() {
    $('#js-search-save-id').on('click', function() {
        var title  = $('#js-search-title-id').val();
        var filter = $('#js-filter-sideform-id').objectize();
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'save-search', 'title': title, 'filter': filter['F']},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    
                }
            }
        });
    });
});