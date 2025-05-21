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
$has_images           = ! empty($images);
$first_image_url      = $has_images ? esc_url($images[0]['url']) : '';
$content_position     = get_field('content_placement') ?: 'bottom center';
$overlay_style        = get_field('overlay_style') ?: 'flat';
$overlay_hex          = get_field('overlay_color') ?: '#000000';
$overlay_opacity_raw  = get_field('overlay_opacity') ?: 50;
$overlay_opacity      = $overlay_opacity_raw / 100;
$min_height_desktop   = get_field('min_height_desktop') ?: '500px';
$min_height_mobile    = get_field('min_height_mobile') ?: '300px';

$image_padding_left = (float) get_field('image_padding_left') ?: 0;
$image_padding_left_unit = $image_padding_left . '%';
$image_width_unit = $image_padding_left > 0 ? 'calc(100% - ' . $image_padding_left_unit . ')' : '100%';

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

// Editor-only style attribute
$dynamic_preview_style = '';
if ( $is_preview ) {
	$selector = '#' . $block_id;
	$image_offset = $image_padding_left > 0 ? 'calc(100% - ' . $image_padding_left_unit . ')' : '100%';

	$dynamic_preview_style = "
		{$selector} {
			position: relative;
			background: none;
		}
		{$selector} .yakstretch-image-wrapper::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: {$image_padding_left_unit};
			height: 100%;
			background-color: {$overlay_rgba};
			z-index: -1;
		}
		{$selector} .yakstretch-image-wrapper {
			background-image: url('{$first_image_url}');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-color: transparent;
			width: 100%;
			height: 100%;
			position: relative;
			overflow: hidden;
		}
		{$selector} .yakstretch-image-rotator {
			width: {$image_offset};
			height: 100%;
			position: absolute;
			top: 0;
			right: 0;
			z-index: -2;
		}
	";
}


?>

<div id="<?php echo esc_attr($block_id); ?>"
     class="<?php echo esc_attr($wrapper_classes); ?>"
     data-yakstretch="1"
     data-has-gallery="<?php echo $has_images ? '1' : '0'; ?>"
	 >

	<?php
	$image_urls = [];
	if ( is_array($images) ) {
		foreach ( $images as $img ) {
			if ( is_array($img) && isset($img['url']) ) {
				$image_urls[] = esc_url_raw($img['url']);
			}
		}
	}
	?>

	<div class="yakstretch-image-wrapper">
		<?php if ( $image_padding_left > 0 ) : ?>
			<div class="yakstretch-overlay-solid-left"
				style="left: 0; width: <?php echo esc_attr($image_padding_left_unit); ?>; height: 100%; background-color: <?php echo esc_attr($overlay_rgba); ?>;">
			</div>
		<?php endif; ?>

		<div class="yakstretch-image-rotator"
			style="width: <?php echo esc_attr($image_width_unit); ?>; right: 0;"
			data-images='<?php echo wp_json_encode(wp_list_pluck($images, 'url')); ?>'
			data-delay='<?php echo esc_attr(get_field('delay') ?: 6000); ?>'
			data-fade='<?php echo esc_attr(get_field('fade') ?: 1000); ?>'
			data-randomize='<?php echo get_field('randomize') ? '1' : '0'; ?>'>
		</div>
	</div>

	<?php
		$gradient_left_style = '';
		if ( $image_padding_left > 0 ) {
			$gradient_left_style = 'left: ' . $image_padding_left_unit . ';';
		}
	?>

	<div class="yakstretch-overlay yakstretch-overlay-<?php echo esc_attr($overlay_style); ?>
		<?php echo esc_attr($gradient_direction_class); ?>"
		style="--yak-overlay-color: <?php echo esc_attr($overlay_rgba); ?>;
		<?php echo $gradient_left_style; ?>">
	</div>

	<div class="yakstretch-content <?php echo esc_attr($placement_class); ?>">
		<?php if ( $is_preview && ! $has_images ) : ?>
			<p style="color: white; padding: 1rem;"><em>No images selected yet.</em></p>
		<?php endif; ?>
		<InnerBlocks />
	</div>

	<style>
		/* Scoped min-height styles */
		#<?php echo esc_attr($block_id); ?> {
			min-height: <?php echo esc_attr($min_height_desktop); ?>;
			width: 100%;
		}
		@media (max-width: 767px) {
			#<?php echo esc_attr($block_id); ?> {
				min-height: <?php echo esc_attr($min_height_mobile); ?>;
			}
		}
	</style>
	<?php if ( $dynamic_preview_style ) : ?>
		<style><?php echo $dynamic_preview_style; ?></style>
	<?php endif; ?>


</div>
