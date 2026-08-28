<?php

function get_image_and_alt($Image){

    if($Image != ""){
        $ImageSRC = $Image['sizes'][ 'large' ];
        $ImageAlt = esc_attr($Image['alt']);
    }
    else{
        global $PlaceholderImageURL;
        global $PlaceholderImageAlt;
        $ImageSRC = $PlaceholderImageURL;
        $ImageAlt = $PlaceholderImageAlt;
    }
    
    return [
        'src' => $ImageSRC,
        'alt' => $ImageAlt
    ];

}