$(document).ready(function() {
	$('#js-form-mail-contacts-submit-id').on('click', function(e) {
		var $that = $(this);
		
		$.ajax({
			url: '/remote',
			type: 'post',
			data: {'action': 'send-form-contacts'},
			beforeSend: function () {
				$that.prop('disabled', 'disabled');
			},
			succees: function (response) {
				$that.prop('disabled', false);
			}
		});
	});
});