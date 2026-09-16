<?php
//Load CSS Function
function load_css() {

    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );
        
    wp_register_style('bootstrap', get_template_directory_uri() . "/css/bootstrap/bootstrap.css", array(), $theme_version);
    wp_enqueue_style('bootstrap');

    wp_register_style('font-awesome', get_template_directory_uri() . "/css/all.min.css", array(), $theme_version);
    wp_enqueue_style('font-awesome');
    
    wp_register_style('main', get_template_directory_uri() . "/css/custom/main.css", array(), $theme_version);
    wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');

//Load JS Function
function load_js() {

    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    wp_register_script('bootstrap', get_template_directory_uri() . "/js/min/bootstrap/bootstrap.bundle.js", array(), $theme_version);
    wp_enqueue_script('bootstrap');   

    wp_register_script('prevent_animation_when_loading', get_template_directory_uri() . "/js/min/page_load/prevent_animation_when_loading.js", array(), $theme_version);
    wp_enqueue_script('prevent_animation_when_loading');

    // "Video launching in" countdown — only needed on the promo page's two
    // language templates (see .PromoVideoCountdown in the video section of
    // each), not site-wide.
    if ( is_page_template( array( 'template-educators-united-promo.php', 'template-educators-united-promo-fr.php' ) ) ) {
        wp_register_script('promo_countdown', get_template_directory_uri() . "/js/min/promo_countdown/promo_countdown.js", array(), $theme_version, true);
        wp_enqueue_script('promo_countdown');
    }

}
add_action('wp_enqueue_scripts', 'load_js');