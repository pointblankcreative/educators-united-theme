<?php 

function acfp_block_category( $categories ) {
    $custom_block = array(
		'slug' => 'acfp-blocks',
		'title' => __( 'Advanced Custom Fields Pro Blocks' ),
    );

    $categories_sorted = array();
    $categories_sorted[0] = $custom_block;

    foreach ($categories as $category) {
        $categories_sorted[] = $category;
    }

    return $categories_sorted;
}
add_filter( 'block_categories_all', 'acfp_block_category', 10, 2);