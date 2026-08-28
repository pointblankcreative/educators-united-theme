<?php
/**
 * Pattern: Test Font Sizes and CTA Button Block
 *
 * Registers a Gutenberg pattern to preview heading levels, paragraph, list, and the CTA Button Block.
 */
if ( ! function_exists( 'register_block_pattern' ) ) {
	return;
}

add_action( 'init', function() {
	register_block_pattern(
		'underfunded/test-font-sizes-and-cta-button-block',
		array(
			'title'       => __( 'Test Font Sizes and CTA Button Block', 'underfunded' ),
			'description' => _x( 'Heading levels 1–6, a paragraph, unordered list with 3 items, and a CTA Button Block for testing theme typography and the CTA block.', 'Block pattern description', 'underfunded' ),
			'categories'  => array( 'text' ),
			'keywords'    => array( 'test', 'font', 'typography', 'headings', 'cta', 'button' ),
			'content'     => '<!-- wp:heading {"level":1} -->
				<h1 class="wp-block-heading">Heading 1</h1>
				<!-- /wp:heading -->

				<!-- wp:heading {"level":2} -->
				<h2 class="wp-block-heading">Heading 2</h2>
				<!-- /wp:heading -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Heading 3</h3>
				<!-- /wp:heading -->

				<!-- wp:heading {"level":4} -->
				<h4 class="wp-block-heading">Heading 4</h4>
				<!-- /wp:heading -->

				<!-- wp:heading {"level":5} -->
				<h5 class="wp-block-heading">Heading 5</h5>
				<!-- /wp:heading -->

				<!-- wp:heading {"level":6} -->
				<h6 class="wp-block-heading">Heading 6</h6>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul class="wp-block-list">
				<li>Lorem ipsum dolor sit amet.</li>
				<li>Consectetur adipiscing elit.</li>
				<li>Sed do eiusmod tempor incididunt.</li>
				</ul>
				<!-- /wp:list -->

				<!-- wp:acf/cta-button-block {"name":"acf/cta-button-block","data":{"cta_button_block-_button_type":"link","_cta_button_block-_button_type":"field_698268801655c","cta_button_block-_link_text":{"title":"Test Button","url":"#","target":""},"_cta_button_block-_link_text":"field_65317d65ecdc2","cta_button_block-_button_colour":"dark","_cta_button_block-_button_colour":"field_622ba5a542f70","cta_button_block-_desktop_alignment":"start","_cta_button_block-_desktop_alignment":"field_621e51ddeae83","cta_button_block-_adjust_view_alignment":"None","_cta_button_block-_adjust_view_alignment":"field_621e5221eae84"},"mode":"preview","className":"wp-block-acf-cta-button-block"} /-->
			',
		)
	);
} );
