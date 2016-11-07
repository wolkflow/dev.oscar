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
                    $('#js-search-title-id').val('');
                    $('#js-searches-id').append('<li><a href="' + response.data['filter'] + '">' + response.data['title'] + '</a></li>');
                }
            }
        });
    });
    
    
    $('#js-search-remove-id').on('click', function() {
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'remove-search'},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-search-title-id').val('');
                    $('#js-searches-id').html('');
                }
            }
        });
    });
});