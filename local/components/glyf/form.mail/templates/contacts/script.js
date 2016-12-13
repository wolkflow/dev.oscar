$(document).ready(function() {
	$('#js-form-mail-contacts-submit-id').on('click', function(e) {
		var $that = $(this);
		
		$.ajax({
			url: '/remote/',
			type: 'post',
			data: {'action': 'send-form-contacts'},
			beforeSend: function () {
				$that.prop('disabled', 'disabled');
			},
			succees: function (response) {
                if (response.status) {
                    inform(response.message);
                } else {
                    error(response.message);
                }
				$that.prop('disabled', false);
			}
		});
	});
});