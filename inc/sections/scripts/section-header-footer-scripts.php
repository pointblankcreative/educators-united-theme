<?php
/**
 * Header / Footer / Body scripts from ACF options (Misc Site Settings > Header Footer Scripts).
 * Output is hooked into wp_head, wp_footer, and wp_body_open.
 * Each script can be limited to specific pages via ACF Post Object field.
 *
 * ACF structure (repeater header_footer_scripts-_scripts):
 *   - _script_name       (text, for comments)
 *   - _script_location   (header | footer | body)
 *   - _script_page_locations (all | specific)
 *   - _specific_pages    (post object, multiple, when specific)
 *   - _script            (textarea, the code)
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$script_field_prefix = 'header_footer_scripts-';

/**
 * Check if a script row should run on the current request (front only).
 *
 * @param array $row Repeater row with _script_page_locations and _specific_pages.
 * @return bool
 */
function theme_script_should_show_on_page( $row ) {
	$prefix = 'header_footer_scripts-';
	$where  = isset( $row[ $prefix . '_script_page_locations' ] ) ? $row[ $prefix . '_script_page_locations' ] : 'all';

	if ( $where === 'all' ) {
		return true;
	}

	if ( $where !== 'specific' ) {
		return false;
	}

	$specific = isset( $row[ $prefix . '_specific_pages' ] ) ? $row[ $prefix . '_specific_pages' ] : null;
	if ( empty( $specific ) ) {
		return false;
	}

	// Normalise to array of IDs (ACF can return array of WP_Post or array of IDs depending on return format).
	$ids = array();
	foreach ( (array) $specific as $p ) {
		if ( is_object( $p ) && isset( $p->ID ) ) {
			$ids[] = (int) $p->ID;
		} elseif ( is_numeric( $p ) ) {
			$ids[] = (int) $p;
		}
	}

	$current_id = (int) get_queried_object_id();
	return $current_id > 0 && in_array( $current_id, $ids, true );
}

/**
 * Output scripts for a given location (header, footer, or body).
 * Uses ob_start/ob_get_clean so script content is captured and printed in one go.
 *
 * @param string $location One of: header, footer, body.
 */
function theme_output_scripts_for_location( $location ) {
	if ( ! in_array( $location, array( 'header', 'footer', 'body' ), true ) ) {
		return;
	}

	$prefix  = 'header_footer_scripts-';
	$scripts = function_exists( 'get_field' ) ? get_field( $prefix . '_scripts', 'option' ) : null;
	if ( ! is_array( $scripts ) || empty( $scripts ) ) {
		return;
	}

	foreach ( $scripts as $row ) {
		$row_location = isset( $row[ $prefix . '_script_location' ] ) ? $row[ $prefix . '_script_location' ] : '';
		if ( $row_location !== $location ) {
			continue;
		}

		if ( ! theme_script_should_show_on_page( $row ) ) {
			continue;
		}

		$code = isset( $row[ $prefix . '_script' ] ) ? trim( (string) $row[ $prefix . '_script' ] ) : '';
		if ( $code === '' ) {
			continue;
		}

		$name = isset( $row[ $prefix . '_script_name' ] ) ? sanitize_text_field( $row[ $prefix . '_script_name' ] ) : '';

		ob_start();
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- intentional script output from admin
		echo $code;
		$output = ob_get_clean();

		if ( $output !== '' ) {
			if ( $name ) {
				echo "\n<!-- " . esc_html( $name ) . " -->\n";
			}
			echo $output . "\n";
		}
	}
}

/**
 * Callback for wp_head: output header scripts.
 */
function theme_header_footer_scripts_head() {
	theme_output_scripts_for_location( 'header' );
}

/**
 * Callback for wp_footer: output footer scripts.
 */
function theme_header_footer_scripts_footer() {
	theme_output_scripts_for_location( 'footer' );
}

/**
 * Callback for wp_body_open: output body scripts (right after <body>).
 */
function theme_header_footer_scripts_body() {
	theme_output_scripts_for_location( 'body' );
}

// Only hook on front; options page slug is acf-options-header-footer-scripts
add_action( 'wp_head', 'theme_header_footer_scripts_head', 5 );
add_action( 'wp_footer', 'theme_header_footer_scripts_footer', 5 );
add_action( 'wp_body_open', 'theme_header_footer_scripts_body', 5 );
