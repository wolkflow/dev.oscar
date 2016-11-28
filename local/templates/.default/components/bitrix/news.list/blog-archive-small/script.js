$(document).ready(function() {
    // Изменение текущей страницы.
    $(document).on('click', '#js-blog-archive-nav-id .js-page', function() {
        var page    = parseInt($(this).data('page'));
        var section = location.href.split('/')[4];
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'blog.archive', 'section': section, 'PAGEN_1': page},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-blog-archive-wrapper-id').html(response.data['html']);
                }
            }
        });
    });
});