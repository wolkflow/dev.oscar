$(document).ready(function() {
	$('#js-form-mail-contacts-submit-id').on('click', function(e) {
        e.preventDefault();
        
		var $that = $(this);
        var $form = $that.closest('#js-form-mail-contacts-id');
		var data  = $form.objectize();
        
        data['action'] = 'send-form-contacts';
        
		$.ajax({
			url: '/remote/',
			type: 'post',
			data: data,
			beforeSend: function () {
				$that.prop('disabled', 'disabled');
			},
			success: function (response) {
                if (response.status) {
                    inform(response.message);
                } else {
                    error(response.message);
                }
				$that.prop('disabled', false);
			}
		});
        return false;
	});
});