<?php

function wpdocs_theme_slug_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Error Page Content' ),
        'id'            => 'error-page-content',
        'description'   => __( 'Content in this area will be shown on the 404 error page.' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );