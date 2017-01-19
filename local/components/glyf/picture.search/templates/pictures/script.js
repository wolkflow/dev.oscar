$(document).ready(function() {
    
    function setEqualHeight(columns)
	{
		var tallestcolumn = 0;
		columns.each(
			function()
			{
				currentHeight = $(this).height();
				if(currentHeight > tallestcolumn)
				{
					tallestcolumn = currentHeight;
				}
			}
		);
		columns.height(tallestcolumn);
	}
    
    
    
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
    
    
    // Изменение текущей страницы.
    $(document).on('click', '#js-search-nav-id .js-page', function() {
        var page   = parseInt($(this).data('page'));
        var filter = $('#js-search-wrapper-id').data('filter');
        
        $.ajax({
            url: '/remote/',
            type: 'post',
            data: {'action': 'get-html', 'inc': 'picture.search', 'page': page, 'F': filter},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#js-search-wrapper-id').html(response.data['html']);
                    
                    setEqualHeight($(".subscribeCol-list"));
                    setEqualHeight($(".subscribeSearch-col"));
                    setEqualHeight($(".catalogItem-alt"));
                    
                    $(window).resize(function() {
                        setEqualHeight($(".subscribeCol-list"));
                        setEqualHeight($(".subscribeSearch-col"));
                        setEqualHeight($(".catalogItem-alt"));
                    });
                }
            }
        });
    });

    // Добавление в корзину.
    /*
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
                } else {
                    error(response.message);
                }
            }
        });
    });
    */
});