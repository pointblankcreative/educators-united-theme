<?php

////BLOCKS
    //Accordion Block
    wp_register_style( 'accordion_block', get_template_directory_uri() . '/css/blocks/accordion_block.css', array(), $theme_version);

    //Container Dividers
    wp_register_style( 'container', get_template_directory_uri() . '/css/blocks/container_block.css', array(), $theme_version);

    //Custom Embed Block Styles
    wp_register_style( 'embed', get_template_directory_uri() . '/css/blocks/custom_embed_block.css', array(), $theme_version);

    //Share Buttons CSS
    wp_register_style( 'share_buttons', get_template_directory_uri() . '/css/blocks/share_buttons_block.css', array(), $theme_version);

    // Podfont (for Google Podcasts icon – loaded from CDN so woff/ttf font works)
    wp_register_style( 'podfonts', 'https://cdn.podfonts.com/releases/v1.1.0/css/podfonts.css', array(), '1.1.0' );

    //Social Media Buttons Block
    wp_register_style( 'social_media_buttons', get_template_directory_uri() . '/css/blocks/social_media_buttons_block.css', array( 'podfonts' ), $theme_version);

    //Video Hover Animations
    wp_register_style( 'video_hover_animations', get_template_directory_uri() . '/css/blocks/video_hover_animations.css', array(), $theme_version);

    //Read More Block
    wp_register_style('read_more_block', get_template_directory_uri() . '/css/blocks/read_more_block.css', array(), $theme_version);

    //Popup Block
    wp_register_style('popup', get_template_directory_uri() . '/css/blocks/popup.css', array(), $theme_version);

    //files_block
    wp_register_style('files_block', get_template_directory_uri() . '/css/blocks/files_block.css', array(), $theme_version);

    //form_container_block
    wp_register_style('form_container_block', get_template_directory_uri() . '/css/blocks/form_container_block.css', array(), $theme_version);

    //slider_gallery
    wp_register_style( 'slider_gallery', get_template_directory_uri() . '/css/blocks/slider_gallery.css', array(), $theme_version);


////LIBRARIES

    //Scroll Into View Library | https://github.com/michalsnik/aos
    wp_register_style('scroll_animation_library', get_template_directory_uri() . '/css/aos/aos.css', array(), $theme_version);

    //splide | carousel 
    wp_register_style('splide', get_template_directory_uri() . '/css/splide/splide.min.css', array(), $theme_version);

    //Glightbox
    wp_register_style('glightbox', get_template_directory_uri() . '/css/glightbox/glightbox.min.css', array(), $theme_version);


////TEMPLATES
    //archive_card
    wp_register_style('archive_card', get_template_directory_uri() . '/css/templates/archive_card.css', array(), $theme_version);