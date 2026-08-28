<?php
/**
 * Single source for theme editor colours.
 * Used by: Gutenberg palette, TinyMCE text colours, ACF colour picker.
 *
 * @global array $theme_editor_colours Slug => hex (e.g. 'primary' => '#2f2f77')
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$GLOBALS['theme_editor_colours'] = [
	'primary'   => '#2f2f77',
	'secondary' => '#ffa500',
	'success'   => '#198754',
	'warning'   => '#FFCC00',
	'danger'    => '#FF4422',
	'dark'      => '#000000',
	'light'     => '#ffffff',
];
