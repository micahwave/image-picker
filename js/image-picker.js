jQuery(document).ready(function($) {

	var modal,
		current_field;

	modal = wp.media({
		title: 'Select an image to upload',
		button: {
			text: 'Use this image',
		},
		multiple: false
	});

	modal.on('select', function() {
		var attachment = modal.state().get('selection').first().toJSON();

		var img = document.createElement('img');
		img.src = attachment.url;

		$('#preview_' + current_field).html(img);
		$('#' + current_field).val(attachment.id);
		$('#remove_' + current_field).show();
	});

	// make sure we have fields to work with
	if ( Array.isArray( image_picker_fields ) ) {

		image_picker_fields.forEach(function(field) {

			// upload field
			$('#upload_' + field).on('click', function(e) {
				e.preventDefault();
				current_field = field;
				modal.open();
			});

			// remove field
			$('#remove_' + field).on('click', function() {
				$('#preview_' + field).html('');
				$('#' + field).val('');
				$('#remove_' + field).hide();
			});
		});
	}
});
