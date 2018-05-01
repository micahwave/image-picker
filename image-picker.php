<?php

require_once( __DIR__ . '/plugin.php' );

use WordPress\Plugins\ImagePicker\Plugin;
$image_picker = new Plugin();

if ( ! function_exists( 'image_picker' ) ) {

/**
 * Registers a field and creates markup
 * @param  string $name
 * @param  int $image_id
 * @return void
 */
function image_picker( $field_name, $image_id ) {

	global $image_picker;

	// add this specific field
	$image_picker->register_field( $field_name );

	?>
	<div id="<?php echo esc_attr( 'preview_' . $field_name ); ?>" class="image-picker-preview">
		<?php if ( ! empty( $image_id ) ) : ?>
			<?php echo wp_get_attachment_image( $image_id, array( 150, 9999 ) ); ?>
		<?php endif; ?>
	</div>
	<div class="image-picker-buttons">
		<input type="button" id="<?php echo esc_attr( 'upload_' . $field_name ); ?>" value="Upload" class="button-primary">
		<input type="button" id="<?php echo esc_attr( 'remove_' . $field_name ); ?>" class="button" value="Remove" <?php if ( empty( $image_id ) ) echo 'style="display:none;"'; ?>/>
	</div>
	<input type="hidden" id="<?php echo esc_attr( $field_name ); ?>" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo absint( $image_id ); ?>">
	<?php
}

}
