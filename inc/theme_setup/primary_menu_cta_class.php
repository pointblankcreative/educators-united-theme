<?php
/**
 * Add CTANavButton class to primary menu items when ACF field
 * primary_menu_cta:_turn_button_into_cta_button is true.
 * Only affects navigations using the primary-menu location.
 */

add_filter( 'nav_menu_css_class', 'pbtheme_primary_menu_cta_class', 10, 4 );

function pbtheme_primary_menu_cta_class( $classes, $item, $args = null, $depth = 0 ) {
    // Only run for primary menu (skip footer and other menus)
    if ( is_object( $args ) && isset( $args->theme_location ) && $args->theme_location !== 'primary-menu' ) {
        return $classes;
    }
    if ( ! function_exists( 'get_field' ) ) {
        return $classes;
    }
    $is_cta = get_field( 'primary_menu_cta-_turn_button_into_cta_button', $item );
    if ( $is_cta ) {
        $classes[] = 'CTANavButton';
    }
    return $classes;
}
