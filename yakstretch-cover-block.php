<?php
/*
Plugin Name: Tomatillo Design ~ Yakstretch Cover Block
Description: Custom block for displaying content on top of a rotating slideshow. Great for "hero" sections.
Plugin URI: https://github.com/tomatillodesign/yak-card-deck
Author: Tomatillo Design
Version: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/



// Examples below!
// See documentation:
// https://www.advancedcustomfields.com/resources/blocks/
// https://www.advancedcustomfields.com/resources/acf_register_block_type/
//
// IMPORTANT: Remember to create your own custom fields in ACF and set them to the correct Block
// See the attached ACF .json for getting started (import this into ACF using the ACF-->Tools)
//


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if ACF PRO is active
function custom_plugin_check_acf_pro_yakstretch() {
    if (!class_exists('ACF') || !function_exists('acf_get_setting') || !acf_get_setting('pro')) {
        add_action('admin_notices', 'custom_plugin_acf_pro_admin_notice_yakstretch');
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate the plugin
    }
}

// Display an admin notice
function custom_plugin_acf_pro_admin_notice_yakstretch() {
    echo '<div class="notice notice-error"><p><strong>Tomatillo Design ~ Yak Card Deck:</strong> This plugin requires <a href="https://www.advancedcustomfields.com/pro/" target="_blank">ACF PRO</a> to be installed and activated.</p></div>';
}

// Run the check on activation
register_activation_hook(__FILE__, 'custom_plugin_check_acf_pro_yakstretch');

// Run the check on admin init
add_action('admin_init', 'custom_plugin_check_acf_pro');

add_action( 'init', function() {
	register_block_type( __DIR__ . '/blocks/yakstretch/block.json' );
});

add_action( 'enqueue_block_assets', function() {
	// Frontend only, enqueue only if block is present
	if ( has_block( 'yak/yakstretch-cover' ) ) {
		wp_enqueue_script(
			'yakstretch-script',
			plugin_dir_url( __FILE__ ) . 'blocks/yakstretch/yakstretch.js',
			[],
			'1.0.0',
			true
		);

		wp_enqueue_style(
			'yakstretch-style',
			plugin_dir_url( __FILE__ ) . 'blocks/yakstretch/yakstretch_cover.css',
			[],
			'1.0.0'
		);
	}
});

add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_style(
		'yakstretch-editor-style',
		plugin_dir_url( __FILE__ ) . 'blocks/yakstretch/editor.css',
		[],
		'1.0.0'
	);

	wp_enqueue_script(
		'yakstretch-editor-script',
		plugin_dir_url( __FILE__ ) . 'blocks/yakstretch/editor.js',
		[],
		'1.0.0',
		true
	);
});





add_action( 'acf/init', function() {
	acf_add_local_field_group([
		'key' => 'group_yakstretch',
		'title' => 'YakStretch Cover Settings',
		'fields' => [

			[
				'key' => 'field_yakstretch_gallery',
				'label' => 'Background Gallery',
				'name' => 'gallery',
				'type' => 'gallery',
				'required' => 1,
			],
			[
				'key' => 'field_yakstretch_randomize',
				'label' => 'Randomize Order',
				'name' => 'randomize',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
			],
			[
				'key' => 'field_yakstretch_position',
				'label' => 'Content Placement',
				'name' => 'content_placement',
				'type' => 'select',
				'choices' => [
					'top-left' => 'Top Left',
					'top-center' => 'Top Center',
					'top-right' => 'Top Right',
					'center-left' => 'Center Left',
					'center-center' => 'Center Center',
					'center-right' => 'Center Right',
					'bottom-left' => 'Bottom Left',
					'bottom-center' => 'Bottom Center',
					'bottom-right' => 'Bottom Right',
				],
				'default_value' => 'bottom-center',
			],
			[
				'key' => 'field_yakstretch_delay',
				'label' => 'Delay Between Images (ms)',
				'name' => 'delay',
				'type' => 'number',
				'default_value' => 6000,
				'append' => 'ms',
			],
			[
				'key' => 'field_yakstretch_fade',
				'label' => 'Fade Duration (ms)',
				'name' => 'fade',
				'type' => 'number',
				'default_value' => 1000,
				'append' => 'ms',
			],
			[
				'key' => 'field_yakstretch_overlay_style',
				'label' => 'Overlay Style',
				'name' => 'overlay_style',
				'type' => 'select',
				'choices' => [
					'flat' => 'Flat Color',
					'gradient' => 'Gradient to Transparent',
				],
				'default_value' => 'flat',
			],
			[
				'key' => 'field_yakstretch_overlay_color',
				'label' => 'Overlay Color',
				'name' => 'overlay_color',
				'type' => 'color_picker',
			],
			[
				'key' => 'field_yakstretch_overlay_opacity',
				'label' => 'Overlay Opacity %',
				'name' => 'overlay_opacity',
				'type' => 'number',
				'default_value' => 50,
				'min' => 0,
				'max' => 100,
				'step' => 1,
			],
			[
				'key' => 'field_yakstretch_height_desktop',
				'label' => 'Min Height (Desktop)',
				'name' => 'min_height_desktop',
				'type' => 'select',
				'choices' => [
					'none' => 'None',
					'300px' => '300px',
					'500px' => '500px',
					'67vh' => '67vh',
					'100vh' => '100vh',
				],
				'default_value' => '500px',
			],
			[
				'key' => 'field_yakstretch_height_mobile',
				'label' => 'Min Height (Mobile)',
				'name' => 'min_height_mobile',
				'type' => 'select',
				'choices' => [
					'none' => 'None',
					'200px' => '200px',
					'300px' => '300px',
					'400px' => '400px',
					'67vh' => '67vh',
					'100vh' => '100vh',
				],
				'default_value' => '300px',
			],

		],
		'location' => [
			[
				[
					'param' => 'block',
					'operator' => '==',
					'value' => 'yak/yakstretch-cover',
				],
			],
		],
	]);
});



function yakstretch_hex_to_rgba_9273614($hex, $opacity = 1) {
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) === 3) {
		$r = hexdec($hex[0] . $hex[0]);
		$g = hexdec($hex[1] . $hex[1]);
		$b = hexdec($hex[2] . $hex[2]);
	} else {
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));
	}
	return "rgba($r, $g, $b, $opacity)";
}