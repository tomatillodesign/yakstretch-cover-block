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
function custom_plugin_check_acf_pro() {
    if (!class_exists('ACF') || !function_exists('acf_get_setting') || !acf_get_setting('pro')) {
        add_action('admin_notices', 'custom_plugin_acf_pro_admin_notice');
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate the plugin
    }
}

// Display an admin notice
function custom_plugin_acf_pro_admin_notice() {
    echo '<div class="notice notice-error"><p><strong>Tomatillo Design ~ Yak Card Deck:</strong> This plugin requires <a href="https://www.advancedcustomfields.com/pro/" target="_blank">ACF PRO</a> to be installed and activated.</p></div>';
}

// Run the check on activation
register_activation_hook(__FILE__, 'custom_plugin_check_acf_pro');

// Run the check on admin init
add_action('admin_init', 'custom_plugin_check_acf_pro');



add_action( 'init', 'clb_custom_acf_blocks_register_acf_blocks_d3fdcc70' );
function clb_custom_acf_blocks_register_acf_blocks_d3fdcc70() {
    register_block_type( plugin_dir_path( __FILE__ ) . 'blocks/clb-custom-info-card' );
}




if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_637d2374119f6',
        'title' => 'Block - Custom Info Cards',
        'fields' => array(
            array(
                'key' => 'field_637e2c4654db2',
                'label' => 'Card Settings',
                'name' => '',
                'aria-label' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_637e268186b76',
                'label' => 'Card Settings',
                'name' => 'td_info_cards_settings_group',
                'aria-label' => '',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_637e26ceca8b3',
                        'label' => 'Number of Columns',
                        'name' => 'td_info_cards_number_of_columns',
                        'aria-label' => '',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            1 => '1',
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                            6 => '6',
                        ),
                        'default_value' => 3,
                        'return_format' => 'value',
                        'allow_null' => 0,
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_637e299dcdz04',
                        'label' => 'Layout',
                        'name' => 'td_info_cards_single_column_layout',
                        'aria-label' => '',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e26ceca8b3',
                                    'operator' => '==',
                                    'value' => 1,
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'horizontal' => 'Horizontal',
                            'full_size' => 'Full Size',
                        ),
                        'default_value' => 'horizontal',
                        'return_format' => 'value',
                        'allow_null' => 0,
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_637e271af8dd7',
                        'label' => 'Card Type',
                        'name' => 'td_info_cards_type',
                        'aria-label' => '',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'icon' => 'Icon',
                            'photo' => 'Photo',
                            'cover' => 'Cover',
                            'video' => 'Video',
                            'text' => 'Text',
                        ),
                        'default_value' => '',
                        'return_format' => 'value',
                        'allow_null' => 0,
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_637e27e9859e7',
                        'label' => 'Sub-header?',
                        'name' => 'td_info_cards_include_sub_header',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_637e27b5859e6',
                        'label' => 'Description?',
                        'name' => 'td_info_cards_include_description',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_637e286a102e8',
                        'label' => 'Button?',
                        'name' => 'td_info_cards_include_button',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_637e299dcdb71',
                        'label' => 'Aspect Ratio (width : height)',
                        'name' => 'td_info_cards_aspect_ratio',
                        'aria-label' => '',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'photo',
                                ),
                            ),
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'cover',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            11 => '1:1',
                            32 => '3:2',
                            43 => '4:3',
                            169 => '16:9',
                            23 => '2:3',
                            34 => '3:4',
                            0 => 'Original',
                        ),
                        'default_value' => '',
                        'return_format' => 'value',
                        'allow_null' => 0,
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_637e2b38adbd5',
                        'label' => 'Card Background',
                        'name' => 'td_info_cards_card_background',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '!=',
                                    'value' => 'cover',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'enable_opacity' => 1,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_637e2ba94ea19',
                        'label' => 'Button Background',
                        'name' => 'td_info_cards_button_background',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e286a102e8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'enable_opacity' => 1,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_6387923afc509',
                        'label' => 'Icon Size',
                        'name' => 'td_info_cards_icon_size',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'icon',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'fa-10x' => '10x',
                            'fa-9x' => '9x',
                            'fa-8x' => '8x',
                            'fa-7x' => '7x',
                            'fa-6x' => '6x',
                            'fa-5x' => '5x',
                            'fa-4x' => '4x',
                            'fa-3x' => '3x',
                            'fa-2x' => '2x',
                            'fa-1x' => 'Default font size',
                            'fa-sm' => 'Small',
                            'fa-xs' => 'Extra-small',
                            'fa-2xs' => 'Extra-extra-small',
                        ),
                        'default_value' => 'fa-4x',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_637e2c6254db3',
                'label' => 'Settings END',
                'name' => '',
                'aria-label' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 1,
            ),
            array(
                'key' => 'field_637e2751859e3',
                'label' => 'Info Cards',
                'name' => 'td_info_cards_repeater',
                'aria-label' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'pagination' => 0,
                'min' => 0,
                'max' => 0,
                'collapsed' => 'field_637e2772859e4',
                'button_label' => 'Add Info Card',
                'rows_per_page' => 20,
                'sub_fields' => array(
                    array(
                        'key' => 'field_637e3ff9bb890',
                        'label' => 'Action',
                        'name' => 'card_action',
                        'aria-label' => '',
                        'type' => 'button_group',
                        'instructions' => 'Modal and Collapse cards will display the "Description" field upon clicking.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'default' => 'Default',
                            'modal' => 'Modal (Pop-up)',
                            'collapse' => 'Collapse',
                        ),
                        'default_value' => 'default',
                        'return_format' => 'value',
                        'allow_null' => 0,
                        'layout' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e3bf845cbd',
                        'label' => 'Photo',
                        'name' => 'card_photo',
                        'aria-label' => '',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'Photo',
                                ),
                            ),
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'cover',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => '',
                        'library' => '',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                        'preview_size' => 'medium',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e3bf848acb',
                        'label' => 'Video',
                        'name' => 'card_video',
                        'aria-label' => '',
                        'type' => 'oembed',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'Video',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'width' => '',
			            'height' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_6421e2d9e4b1a',
                        'label' => 'Cover Opacity Percentage',
                        'name' => 'cover_opacity_percentage',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,                            
                        'conditional_logic' => array(
                            array(
                                'field' => 'field_637e271af8dd7',
                                'operator' => '==',
                                'value' => 'cover',
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 50,
                        'min' => 0,
                        'max' => 100,
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => '%',
                        ),
                        array(
                            'key' => 'field_637e3ccc45cbf',
                            'label' => 'Icon Type',
                            'name' => 'card_icon_type',
                            'aria-label' => '',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_637e271af8dd7',
                                        'operator' => '==',
                                        'value' => 'Icon',
                                    ),
                                ),
                            ),
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'classic' => 'Classic',
                                'duotone' => 'Classic Duotone',
                                'sharp' => 'Sharp',
                                'sharp-duotone' => 'Sharp Duotone',
                            ),
                            'default_value' => 'classic',
                            'return_format' => 'value',
                            'multiple' => 0,
                            'allow_null' => 0,
                            'ui' => 0,
                            'ajax' => 0,
                            'placeholder' => '',
                            'parent_repeater' => 'field_637e2751859e3',
                        ),
                    array(
                        'key' => 'field_637e3c2345cbe',
                        'label' => 'Icon Style',
                        'name' => 'card_icon_style',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'Icon',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'thin' => 'Thin',
                            'light' => 'Light',
                            'regular' => 'Regular',
                            'solid' => 'Solid',
                            'brands' => 'Brands',
                        ),
                        'default_value' => 'regular',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e3cf745cc0',
                        'label' => 'Icon',
                        'name' => 'card_icon',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => 'Search and select any icon from https://fontawesome.com/icons. Enter the text name of the icon here, eg "lightbulb."',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e271af8dd7',
                                    'operator' => '==',
                                    'value' => 'Icon',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => 'fa-',
                        'append' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e2772859e4',
                        'label' => 'Heading',
                        'name' => 'card_heading',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e2c03a87cf',
                        'label' => 'Sub-Heading',
                        'name' => 'card_subheading',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e27e9859e7',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e278c859e5',
                        'label' => 'Description',
                        'name' => 'card_description',
                        'aria-label' => '',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e27b5859e6',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                            array(
                                array(
                                    'field' => 'field_637e3ff9bb890',
                                    'operator' => '==',
                                    'value' => 'modal',
                                ),
                            ),
                            array(
                                array(
                                    'field' => 'field_637e3ff9bb890',
                                    'operator' => '==',
                                    'value' => 'collapse',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 0,
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e3b3904522',
                        'label' => 'Button Text',
                        'name' => 'card_button_text',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e286a102e8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Learn More',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                    array(
                        'key' => 'field_637e3b5f04523',
                        'label' => 'Link',
                        'name' => 'card_link',
                        'aria-label' => '',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_637e3ff9bb890',
                                    'operator' => '==',
                                    'value' => 'default',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'parent_repeater' => 'field_637e2751859e3',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/clb-custom-info-card',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    
    endif;		






function clb_hex2hsl_020582308($hexstr) {
        $hexstr = ltrim($hexstr, '#');
        if (strlen($hexstr) == 3) {
            $hexstr = $hexstr[0] . $hexstr[0] . $hexstr[1] . $hexstr[1] . $hexstr[2] . $hexstr[2];
        }
        $R = hexdec($hexstr[0] . $hexstr[1]);
        $G = hexdec($hexstr[2] . $hexstr[3]);
        $B = hexdec($hexstr[4] . $hexstr[5]);
        $RGB = array($R,$G,$B);
//scale value 0 to 255 to floats from 0 to 1
        $r = $RGB[0]/255;
        $g = $RGB[1]/255;
        $b = $RGB[2]/255;
        // using https://gist.github.com/brandonheyer/5254516
        $max = max( $r, $g, $b );
        $min = min( $r, $g, $b );
        // lum
        $l = ( $max + $min ) / 2;

        // sat
        $d = $max - $min;
        if( $d == 0 ){
            $h = $s = 0; // achromatic
        } else {
            $s = $d / ( 1 - abs( (2 * $l) - 1 ) );
            // hue
            switch( $max ){
                case $r:
                    $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * ( ( $b - $r ) / $d + 2 );
                    break;
                case $b:
                    $h = 60 * ( ( $r - $g ) / $d + 4 );
                    break;
            }
        }
        $hsl = array( 'h' => round( $h ), 's' => round( $s*100 ), 'l' => round( $l*100 ) );
        //$hslstr = 'hsl('.($hsl[0]).','.($hsl[1]).'%,'.($hsl[2]).'%)';
        return $hsl;
// or return the $hsl array if you want to make adjustments to values
    }






    /**
     * Input: HSL in format Deg, Perc, Perc
     * Output: An array containing HSL in ranges 0-1
     *
     * Divides $h by 60, and $s and $l by 100.
     *
     * hslToRgb calls this by default.
    */
    function degPercPercToHsl2222023411($h, $s, $l) {
        //convert h, s, and l back to the 0-1 range

        //convert the hue's 360 degrees in a circle to 1
        $h /= 360;

        //convert the saturation and lightness to the 0-1
        //range by multiplying by 100
        $s /= 100;
        $l /= 100;

        $hsl['h'] =  $h;
        $hsl['s'] = $s;
        $hsl['l'] = $l;

        return $hsl;
    }




    /**
     * Converts an HSL color value to RGB. Conversion formula
     * adapted from http://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/.
     * Assumes h, s, and l are in the format Degrees,
     * Percent, Percent, and returns r, g, and b in
     * the range [0 - 255].
     *
     * Called by hslToHex by default.
     *
     * Calls:
     *   degPercPercToHsl
     *   hueToRgb
     *
     * @param   Number  h       The hue value
     * @param   Number  s       The saturation level
     * @param   Number  l       The luminence
     * @return  Array           The RGB representation
     */
    function hslToRgb2222023411($h, $s, $l){
        $hsl = degPercPercToHsl616519615351($h, $s, $l);
        $h = $hsl['h'];
        $s = $hsl['s'];
        $l = $hsl['l'];

        //If there's no saturation, the color is a greyscale,
        //so all three RGB values can be set to the lightness.
        //(Hue doesn't matter, because it's grey, not color)
        if ($s == 0) {
            $r = $l * 255;
            $g = $l * 255;
            $b = $l * 255;
        }
        else {
            //calculate some temperary variables to make the
            //calculation eaisier.
            if ($l < 0.5) {
                $temp2 = $l * (1 + $s);
            } else {
                $temp2 = ($l + $s) - ($s * $l);
            }
            $temp1 = 2 * $l - $temp2;

            //run the calculated vars through hueToRgb to
            //calculate the RGB value.  Note that for the Red
            //value, we add a third (120 degrees), to adjust
            //the hue to the correct section of the circle for
            //red.  Simalarly, for blue, we subtract 1/3.
            $r = 255 * hueToRgb($temp1, $temp2, $h + (1 / 3));
            $g = 255 * hueToRgb($temp1, $temp2, $h);
            $b = 255 * hueToRgb($temp1, $temp2, $h - (1 / 3));
        }

        $rgb['r'] = $r;
        $rgb['g'] = $g;
        $rgb['b'] = $b;

        return $rgb;
    }



    /**
 * Converts an HSL hue to it's RGB value.
 *
 * Input: $temp1 and $temp2 - temperary vars based on
 * whether the lumanence is less than 0.5, and
 * calculated using the saturation and luminence
 * values.
 *  $hue - the hue (to be converted to an RGB
 * value)  For red, add 1/3 to the hue, green
 * leave it alone, and blue you subtract 1/3
 * from the hue.
 *
 * Output: One RGB value.
 *
 * Thanks to Easy RGB for this function (Hue_2_RGB).
 * http://www.easyrgb.com/index.php?X=MATH&$h=19#text19
 *
*/
function hueToRgb2222023411($temp1, $temp2, $hue) {
    if ($hue < 0) {
        $hue += 1;
    }
    if ($hue > 1) {
        $hue -= 1;
    }

    if ((6 * $hue) < 1 ) {
        return ($temp1 + ($temp2 - $temp1) * 6 * $hue);
    } elseif ((2 * $hue) < 1 ) {
        return $temp2;
    } elseif ((3 * $hue) < 2 ) {
        return ($temp1 + ($temp2 - $temp1) * ((2 / 3) - $hue) * 6);
    }
    return $temp1;
}



    /**
     * Source: https://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion/34363975#34363975
     * Converts HSL to Hex by converting it to
     * RGB, then converting that to hex.
     *
     * string hslToHex($h, $s, $l[, $prependPound = true]
     *
     * $h is the Degrees value of the Hue
     * $s is the Percentage value of the Saturation
     * $l is the Percentage value of the Lightness
     * $prependPound is a bool, whether you want a pound
     *  sign prepended. (optional - default=true)
     *
     * Calls:
     *   hslToRgb
     *
     * Output: Hex in the format: #00ff88 (with
     * pound sign).  Rounded to the nearest whole
     * number.
    */
    function hslToHex2222023411($h, $s, $l, $prependPound = true) {
        //convert hsl to rgb
        $rgb = hslToRgb($h,$s,$l);

        //convert rgb to hex
        $hexR = $rgb['r'];
        $hexG = $rgb['g'];
        $hexB = $rgb['b'];

        //round to the nearest whole number
        $hexR = round($hexR);
        $hexG = round($hexG);
        $hexB = round($hexB);

        //convert to hex
        $hexR = dechex($hexR);
        $hexG = dechex($hexG);
        $hexB = dechex($hexB);

        //check for a non-two string length
        //if it's 1, we can just prepend a
        //0, but if it is anything else non-2,
        //it must return false, as we don't
        //know what format it is in.
        if (strlen($hexR) != 2) {
            if (strlen($hexR) == 1) {
                //probably in format #0f4, etc.
                $hexR = "0" . $hexR;
            } else {
                //unknown format
                return false;
            }
        }
        if (strlen($hexG) != 2) {
            if (strlen($hexG) == 1) {
                $hexG = "0" . $hexG;
            } else {
                return false;
            }
        }
        if (strlen($hexB) != 2) {
            if (strlen($hexB) == 1) {
                $hexB = "0" . $hexB;
            } else {
                return false;
            }
        }

        //if prependPound is set, will prepend a
        //# sign to the beginning of the hex code.
        //(default = true)
        $hex = "";
        if ($prependPound) {
            $hex = "#";
        }

        $hex = $hex . $hexR . $hexG . $hexB;

        return $hex;
    }



// Source: https://www.splitbrain.org/blog/2008-09/18-calculating_color_contrast_with_php
// Use PHP to help automatically determine color contrasts
function lumdiff2222023411($R1,$G1,$B1,$R2,$G2,$B2){
    $L1 = 0.2126 * pow($R1/255, 2.2) +
          0.7152 * pow($G1/255, 2.2) +
          0.0722 * pow($B1/255, 2.2);
 
    $L2 = 0.2126 * pow($R2/255, 2.2) +
          0.7152 * pow($G2/255, 2.2) +
          0.0722 * pow($B2/255, 2.2);
 
    if($L1 > $L2){
        return ($L1+0.05) / ($L2+0.05);
    }else{
        return ($L2+0.05) / ($L1+0.05);
    }
}




    /**
     * Input: HSL in format Deg, Perc, Perc
     * Output: An array containing HSL in ranges 0-1
     *
     * Divides $h by 60, and $s and $l by 100.
     *
     * hslToRgb calls this by default.
    */
    function degPercPercToHsl616519615351($h, $s, $l) {
        //convert h, s, and l back to the 0-1 range

        //convert the hue's 360 degrees in a circle to 1
        $h /= 360;

        //convert the saturation and lightness to the 0-1
        //range by multiplying by 100
        $s /= 100;
        $l /= 100;

        $hsl['h'] =  $h;
        $hsl['s'] = $s;
        $hsl['l'] = $l;

        return $hsl;
    }


