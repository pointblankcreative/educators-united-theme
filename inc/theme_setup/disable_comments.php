<?php
/**
 * Disable comments site-wide.
 * Removes comments from admin, disables support on post types, and closes comments on the frontend.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// Hide comment meta boxes on edit screens.
add_action( 'admin_init', 'theme_remove_comment_meta_boxes' );
function theme_remove_comment_meta_boxes() {
	$post_types = get_post_types( array( 'public' => true ), 'names' );
	foreach ( $post_types as $post_type ) {
		remove_meta_box( 'commentstatusdiv', $post_type, 'normal' );
		remove_meta_box( 'commentsdiv', $post_type, 'normal' );
	}
}

// Close comments and pings on the frontend (no new comments, form hidden).
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments list in dashboard (Dashboard > Activity widget).
add_filter( 'dashboard_recent_comments_args', 'theme_remove_dashboard_comments' );
function theme_remove_dashboard_comments() {
	return array( 'number' => 0 );
}

// Block comment form submission.
add_action( 'pre_comment_on_post', 'theme_block_comment_submission' );
function theme_block_comment_submission() {
	wp_die( __( 'Comments are closed.' ), '', array( 'response' => 403 ) );
}
