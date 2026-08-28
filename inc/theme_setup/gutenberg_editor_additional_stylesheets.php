<?php

function myguten_enqueue() {
    if(is_admin()){
        $the_theme = wp_get_theme();
        $theme_version = $the_theme->get( 'Version' );
    
        wp_enqueue_style('bootstrap', get_template_directory_uri() . "/css/bootstrap/bootstrap.css", array(), $theme_version);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . "/js/min/bootstrap/bootstrap.bundle.js", array(), $theme_version);
        wp_enqueue_style("font_awesome_gutenberg", get_template_directory_uri() . "/css/all.min.css", array(), $theme_version );
        wp_enqueue_style('gutenberg_style', get_template_directory_uri() . "/css/gutenberg/gutenberg.css", array(), $theme_version );
        include get_template_directory() . '/inc/theme_setup/optional_stylesheets_and_script/optional_stylesheets.php';
        include get_template_directory() . '/inc/theme_setup/optional_stylesheets_and_script/optional_scripts.php';
    }
}
add_action( 'enqueue_block_assets', 'myguten_enqueue' );


// Add inline CSS in the post admin head with this php file
function my_custom_admin_head() {
    if(get_current_screen()->is_block_editor()){
        include get_stylesheet_directory() . '/inc/scripts/colour_picker.php';
    }
}
add_action( 'admin_head', 'my_custom_admin_head' );

add_action('enqueue_block_editor_assets', function() {
	wp_enqueue_script('core_spacer_extra_options', get_template_directory_uri() . '/js/min/spacer/core_spacer_extra_options.js', ['wp-edit-post']);
    wp_enqueue_script('core_columns_extra_options', get_template_directory_uri() . '/js/min/columns/core_columns_extra_options.js', ['wp-edit-post']);
});