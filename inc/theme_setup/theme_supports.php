<?php
/*
    Enabled Theme Options
*/

//add_theme_support('menus');
add_theme_support( 'custom-logo' );
add_theme_support('core-block-patterns');
add_theme_support('custom-spacing');
add_theme_support('custom-units');
add_theme_support('editor-styles');
add_theme_support('title-tag');
add_theme_support('wp-block-styles');
add_theme_support( 'responsive-embeds' );

add_theme_support('widgets'); 
add_theme_support('post-thumbnails'); 
add_post_type_support( 'page', 'excerpt' );

global $theme_editor_colours;

if ( function_exists( 'acf_register_block_type' ) ) {
	$palette = [];
	foreach ( $theme_editor_colours as $slug => $hex ) {
		$palette[] = [
			'name'  => esc_html__( ucfirst( $slug ) ),
			'slug'  => $slug,
			'color' => $hex,
		];
	}
	add_theme_support( 'editor-color-palette', $palette );
}

add_filter( 'tiny_mce_before_init', function ( $init ) use ( $theme_editor_colours ) {
	$map = [];
	foreach ( $theme_editor_colours as $label => $hex ) {
		$map[] = '"' . ltrim( $hex, '#' ) . '"';
		$map[] = '"' . ucfirst( $label ) . '"';
	}
	$init['textcolor_map']  = '[' . implode( ',', $map ) . ']';
	$init['textcolor_rows'] = 1;
	return $init;
} );