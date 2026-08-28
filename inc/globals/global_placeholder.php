<?php

function global_placeholder_image() {
    global $PlaceholderImageURL;
    global $PlaceholderImageAlt;

    $PlaceholderImageURL = get_template_directory_uri() ."/images/placeholders/placeholder.jpg";
    $PlaceholderImageAlt = "Placeholder Image";

}
add_action( 'after_setup_theme', 'global_placeholder_image' );
