<?php
/**
 * Remove Posts and Menus from WordPress admin.
 * Hides the Posts menu, Appearance > Menus, and Add New > Post from the backend.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//add_action( 'admin_menu', 'theme_remove_admin_menu_items', 999 );
add_action( 'admin_bar_menu', 'theme_remove_admin_bar_post', 999 );

/**
 * Remove Posts menu and Menus submenu from admin.
 */
function theme_remove_admin_menu_items() {
	// Remove the main Posts menu (Posts, All Posts, Add New, Categories, Tags).
	remove_menu_page( 'edit.php' );

	// Remove Menus from Appearance (Appearance > Menus).
	remove_submenu_page( 'themes.php', 'nav-menus.php' );
}

/**
 * Remove Add New > Post from the admin bar.
 */
function theme_remove_admin_bar_post( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-post' );
}
