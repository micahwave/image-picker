<?php

/**
 * Plugin Name: Image Picker
 * Author: Micah Ernst
 * Description: Allows developers to easily implement a field that lets users pick an image
 * Version: 0.1
 * Author URI: https://micahernst.com
 */

namespace WordPress\Plugins\ImagePicker;

class Plugin {

	var $fields = array();

	/**
	 * Register our actions
	 * @return void
	 */
	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'admin_footer', array( $this, 'footer_scripts' ) );
	}

	/**
	 * Enable wp media and related scripts
	 * @return void
	 */
	public function scripts() {

		// enable wp media on all admin pages
		wp_enqueue_media();

		// add a little css
		wp_enqueue_style(
			'image-picker',
			plugins_url( 'css/style.css', __FILE__ )
		);
	}

	/**
	 * Register our script in the footer so we have time to capture all the fields that have been registered
	 * @return void
	 */
	public function footer_scripts() {

		// turn on our script
		wp_enqueue_script(
			'image-picker',
			plugins_url( 'js/image-picker.js', __FILE__ ),
			array( 'jquery' ),
			null,
			true
		);

		// localize script with name of fields
		wp_localize_script( 'image-picker', 'image_picker_fields', $this->fields );
	}

	/**
	 * Helper to add field
	 * @param string $field_name
	 * @return void
	 */
	public function register_field( $field_name ) {
		$this->fields[] = $field_name;
	}
}
