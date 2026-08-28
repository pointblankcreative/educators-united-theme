<?php
/*
    These are the ACF custom block types.
    After registered here, ACF custom fields can be added and applied via the appropriate block.
*/

function register_acf_blocks() {
	/**
	 * We register our block's with WordPress's handy
	 * register_block_type();
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 */

	//register_block_type( '../blocks/container-block' );
    foreach ( glob( get_stylesheet_directory() . '/inc/blocks/*/' ) as $path ) {
        register_block_type( $path . 'block.json' );
    }

}
// Here we call our register_acf_block() function on init.
if( function_exists('acf_register_block_type') ) {
    add_action( 'init', 'register_acf_blocks' );
}