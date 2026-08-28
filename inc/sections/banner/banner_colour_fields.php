<?php
/**
 * Banner ACF fields and inline styles.
 * Uses $PageFieldPreface (set by the template that includes section_banner, e.g. default_page_options-).
 *
 * Fields used:
 * - _banner_image
 * - _banner_image_repeat (no-repeat | repeat)
 * - _background_image_size (pixels, when repeat)
 * - _banner_image_vertical_position, _banner_image_horizontal_position (%, when no-repeat)
 * - _banner_image_colour_overlay (none | colour | gradient)
 * - _banner_image_overlay_colour (when overlay = colour)
 * - _banner_image_overlay_gradient_colours (repeater), _banner_image_overlay_gradient_colour (sub), _banner_image_overlay_gradient_colours_direction (when overlay = gradient)
 */

if ( ! isset( $PageFieldPreface ) || $PageFieldPreface === '' ) {
	$PageFieldPreface = 'default_page_options-';
}

$BannerStyle   = '';
$BannerImage   = get_field( $PageFieldPreface . '_banner_image' );
$BannerImage   = get_image_and_alt( $BannerImage );
$BannerImageSRC = $BannerImage['src'];
$BannerImageAlt = $BannerImage['alt'];

$repeat    = get_field( $PageFieldPreface . '_banner_image_repeat' );
$overlay   = get_field( $PageFieldPreface . '_banner_image_colour_overlay' );

$styles = array();

// Background image layer(s): overlay first (if any), then image
$bg_layers = array();

if ( $overlay === 'colour' ) {
	$overlay_colour = get_field( $PageFieldPreface . '_banner_image_overlay_colour' );
	if ( $overlay_colour !== '' && $overlay_colour !== null ) {
		$bg_layers[] = 'linear-gradient(0deg, ' . esc_attr( $overlay_colour ) . ', ' . esc_attr( $overlay_colour ) . ')';
	}
} elseif ( $overlay === 'gradient' ) {
	$gradient_rows = get_field( $PageFieldPreface . '_banner_image_overlay_gradient_colours' );
	$direction     = get_field( $PageFieldPreface . '_banner_image_overlay_gradient_colours_direction' );
	if ( is_array( $gradient_rows ) && ! empty( $gradient_rows ) ) {
		$prefix = $PageFieldPreface . '_banner_image_overlay_gradient_colour';
		$stops  = array();
		foreach ( $gradient_rows as $row ) {
			$colour = isset( $row[ $prefix ] ) ? $row[ $prefix ] : '';
			if ( $colour !== '' ) {
				$stops[] = esc_attr( $colour );
			}
		}
		if ( ! empty( $stops ) ) {
			$dir    = in_array( $direction, array( 'to bottom', 'to right', 'to bottom right', 'to top right' ), true ) ? $direction : 'to bottom';
			$bg_layers[] = 'linear-gradient(' . esc_attr( $dir ) . ', ' . implode( ', ', $stops ) . ')';
		}
	}
}

if ( $BannerImageSRC !== '' ) {
	$bg_layers[] = 'url(' . esc_url( $BannerImageSRC ) . ')';
}

if ( ! empty( $bg_layers ) ) {
	$styles[] = 'background-image: ' . implode( ', ', $bg_layers );
}

if ( $repeat === 'repeat' ) {
	$styles[] = 'background-repeat: repeat';
	$size_px  = get_field( $PageFieldPreface . '_background_image_size' );
	if ( $size_px !== '' && $size_px !== null && is_numeric( $size_px ) ) {
		$styles[] = 'background-size: ' . (int) $size_px . 'px';
	}
} else {
	// no-repeat (default)
	$styles[] = 'background-repeat: no-repeat';
	$styles[] = 'background-size: cover';
	$v = get_field( $PageFieldPreface . '_banner_image_vertical_position' );
	$h = get_field( $PageFieldPreface . '_banner_image_horizontal_position' );
	$v = $v !== '' && $v !== null && is_numeric( $v ) ? (int) $v : 50;
	$h = $h !== '' && $h !== null && is_numeric( $h ) ? (int) $h : 50;
	$styles[] = 'background-position: ' . $h . '% ' . $v . '%';
}

if ( ! empty( $styles ) ) {
	$BannerStyle = implode( '; ', $styles );
}