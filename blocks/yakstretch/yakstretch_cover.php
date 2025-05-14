<?php
/**
 * YakStretch Cover Block Template
 *
 * Renders a rotating background image block with overlay and InnerBlocks content.
 */

 $is_preview = is_admin() && function_exists( 'acf_is_block_editor' ) && acf_is_block_editor();


// Unique block ID and class
$block_id = 'yakstretch-' . $block['id'];
$align_class = isset($block['align']) ? 'align' . $block['align'] : '';
$custom_class = isset($block['className']) ? esc_attr($block['className']) : '';

$wrapper_classes = implode(' ', array_filter([
	'yakstretch-cover-block',
	$align_class,
	$custom_class,
]));

// Fields
$images               = get_field('gallery');
$content_position     = get_field('content_placement') ?: 'bottom center';
$overlay_style        = get_field('overlay_style') ?: 'flat';
$overlay_hex          = get_field('overlay_color') ?: '#000000';
$overlay_opacity_raw  = get_field('overlay_opacity') ?: 50;
$overlay_opacity      = $overlay_opacity_raw / 100;
$min_height_desktop   = get_field('min_height_desktop') ?: '500px';
$min_height_mobile    = get_field('min_height_mobile') ?: '300px';
$first_image_url      = ! empty($images) ? esc_url($images[0]['url']) : '';

// CSS class for content placement
$placement_class = 'yakstretch-content-' . str_replace(' ', '-', strtolower($content_position));

// CSS class for gradient direction
$gradient_direction_class = '';
if ( $overlay_style === 'gradient' ) {
	$dir_map = [
		'top'    => 'top-to-bottom',
		'bottom' => 'bottom-to-top',
		'left'   => 'left-to-right',
		'right'  => 'right-to-left',
		'center' => 'center-radial',
	];

	foreach ( $dir_map as $key => $class ) {
		if ( stripos( $content_position, $key ) !== false ) {
			$gradient_direction_class = 'yakstretch-gradient-' . $class;
			break;
		}
	}

	if ( ! $gradient_direction_class ) {
		$gradient_direction_class = 'yakstretch-gradient-default';
	}
}


$overlay_rgba = yakstretch_hex_to_rgba_9273614($overlay_hex, $overlay_opacity);

// Bail early if no images
if ( empty($images) ) {
	echo '<div class="' . esc_attr($wrapper_classes) . '"><p><em>No images selected.</em></p></div>';
	return;
}
?>

<div id="<?php echo esc_attr($block_id); ?>"
     class="<?php echo esc_attr($wrapper_classes); ?>"
     data-yakstretch="1"
     data-has-gallery="<?php echo $images ? '1' : '0'; ?>"
     <?php if ( $is_preview && $first_image_url ) : ?>
         style="background-image: url('<?php echo $first_image_url; ?>'); background-size: cover; background-position: center;"
     <?php endif; ?>>

	<div class="yakstretch-image-rotator"
	     data-images='<?php echo wp_json_encode( wp_list_pluck( $images, 'url' ) ); ?>'
	     data-delay='<?php echo esc_attr( get_field('delay') ?: 6000 ); ?>'
	     data-fade='<?php echo esc_attr( get_field('fade') ?: 1000 ); ?>'
	     data-randomize='<?php echo get_field('randomize') ? '1' : '0'; ?>'>
	</div>

    <?php if ( $is_preview ) : ?>
        <div class="yakstretch-editor-bg"></div>
    <?php endif; ?>

	<div class="yakstretch-overlay
	            yakstretch-overlay-<?php echo esc_attr($overlay_style); ?>
	            <?php echo esc_attr($overlay_style === 'gradient' ? $gradient_direction_class : ''); ?>"
	     style="--yak-overlay-color: <?php echo esc_attr($overlay_rgba); ?>;">
	</div>

	<div class="yakstretch-content <?php echo esc_attr($placement_class); ?>">
		<InnerBlocks />
	</div>

	<style>
		/* Scoped min-height styles */
		#<?php echo esc_attr($block_id); ?> {
			min-height: <?php echo esc_attr($min_height_desktop); ?>;
		}
		@media (max-width: 767px) {
			#<?php echo esc_attr($block_id); ?> {
				min-height: <?php echo esc_attr($min_height_mobile); ?>;
			}
		}
	</style>
</div>
