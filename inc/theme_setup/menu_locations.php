<?php
/*
    Menu Locations
*/
function wpb_custom_new_menu() {
    register_nav_menu('primary-menu',__( 'Primary Menu' ));
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );