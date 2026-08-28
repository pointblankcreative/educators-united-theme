<?php
/**
 * Remove default and all post/comment content when theme is activated.
 * Deletes "Hello World" post, "Sample Page", all posts, and all comments.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_switch_theme', 'theme_remove_default_content' );

/**
 * Delete default content, all posts, and all comments on theme activation.
 */
function theme_remove_default_content() {
	// Only run when this theme is activated.
	if ( get_template() !== 'theme' ) {
		return;
	}

	// Delete default "Hello World" post.
	$hello_world = get_posts(
		array(
			'name'        => 'hello-world',
			'post_type'   => 'post',
			'post_status' => 'any',
			'numberposts' => 1,
		)
	);
	if ( ! empty( $hello_world ) ) {
		wp_delete_post( $hello_world[0]->ID, true );
	}

	// Delete default "Sample Page" if present.
	$sample_page = get_page_by_path( 'sample-page', OBJECT, 'page' );
	if ( $sample_page ) {
		wp_delete_post( $sample_page->ID, true );
	}

	// Delete all comments (run before deleting posts so comments are removed first).
	$comment_ids = get_comments( array( 'fields' => 'ids', 'number' => 0 ) );
	foreach ( $comment_ids as $comment_id ) {
		wp_delete_comment( $comment_id, true );
	}

	// Delete all posts.
	$post_ids = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'any',
			'numberposts'    => -1,
			'fields'         => 'ids',
		)
	);
	foreach ( $post_ids as $post_id ) {
		wp_delete_post( $post_id, true );
	}
}
