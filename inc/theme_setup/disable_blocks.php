<?php
/*
    Disable specific WordPress core blocks
*/

/**
 * Filters the list of allowed block types to remove specific blocks.
 *
 * This function removes a comprehensive list of core blocks from
 * the list of allowed block types in the Editor, including media,
 * layout, widget, site, query, post meta, and embed blocks.
 *
 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $block_editor_context The current block editor context.
 *
 * @return array The filtered list of allowed block types with the specified blocks removed.
 */
function m4rd_disallow_block_types( $allowed_block_types, $block_editor_context ) {
	// Blocks to disallow
	$disallowed_blocks = array(
		// Original blocks
		'core/buttons',
		'core/image',
		// Media blocks
		'core/gallery',
		'core/cover',
		'core/file',
		'core/media-text',
		// Layout blocks
		'core/accordion',
		'core/row',
		'core/stack',
		'core/grid',
		// Post content blocks
		'core/read-more', // Read more
		'core/nextpage', // Page break
		// Widget blocks
		'core/archives',
		'core/calendar',
		'core/term-description', // Terms list
		'core/terms', // Alternative terms list
		'core/categories', // Category list
		'core/latest-comments',
		'core/page-list',
		'core/search',
		'core/social-icons',
		'core/tag-cloud',
		// Site blocks
		'core/navigation',
		'core/site-logo',
		'core/site-tagline',
		// Query blocks
		'core/query-loop',
		// Post meta blocks
		'core/avatar',
		'core/post-author',
		'core/author-name',
		'core/post-author-name',
		'core/post-comments-count',
		'core/post-comments-link',
		'core/post-categories',
		'core/post-tags',
		// Embed blocks
		'core/embed',
		'core-embed/youtube',
		'embed/youtube',
		'core-embed/wordpress',
		'embed/wordpress',
	);
	
	// Get all registered blocks if $allowed_block_types is not already set.
	if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
		$registered_blocks   = WP_Block_Type_Registry::get_instance()->get_all_registered();
		$allowed_block_types = array_keys( $registered_blocks );
	}

	// Create a new array for the allowed blocks.
	$filtered_blocks = array();

	// Loop through each block in the allowed blocks list.
	foreach ( $allowed_block_types as $block ) {
		// Check if the block is not in the disallowed blocks list.
		if ( ! in_array( $block, $disallowed_blocks, true ) ) {
			// If it's not disallowed, add it to the filtered list.
			$filtered_blocks[] = $block;
		}
	}

	// Return the filtered list of allowed blocks
	return $filtered_blocks;
}
add_filter( 'allowed_block_types_all', 'm4rd_disallow_block_types', 10, 2 );
