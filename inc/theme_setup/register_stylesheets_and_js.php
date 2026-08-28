<?php
//Register CSS Function
function register_css() {
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    include get_template_directory() . '/inc/theme_setup/optional_stylesheets_and_script/optional_stylesheets.php';
}
add_action('wp_enqueue_scripts', 'register_css');

//Register JS Function
function register_js() {
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    include get_template_directory() . '/inc/theme_setup/optional_stylesheets_and_script/optional_scripts.php';

}
add_action('wp_enqueue_scripts', 'register_js');