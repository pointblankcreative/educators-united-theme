<?php

////Blocks
    //Custom Embed Block JS | embed block
    wp_register_script( "load_video", get_template_directory_uri() . "/js/min/load_video/load_video.js", array(), $theme_version );

////Page Sections
    //side widget (AKA Form)
    wp_register_script( "side_widget", get_template_directory_uri() . "/js/min/side_widget/side_widget.js", array(), $theme_version );

    //Sticky Alert 
    wp_register_script( "sticky_alert", get_template_directory_uri() . "/js/min/sticky_alert/sticky_alert.js", array(), $theme_version );

    //Scroll Into View Library config
    wp_register_script("scroll_animation_library_start", get_template_directory_uri() . "/js/min/aos/aos-start.js", array(), $theme_version );

    //glightbox_config | used on masonry and slider blocks 
    wp_register_script('glightbox_config', get_template_directory_uri() . '/js/min/glightbox/glightbox_config.js', array(), $theme_version );

////LIBRARIES

    //Scroll Into View Library | https://github.com/michalsnik/aos
    wp_register_script("scroll_animation_library", get_template_directory_uri() . "/js/min/aos/aos.js", array(), $theme_version );

    //glightbox
    wp_register_script('glightbox', get_template_directory_uri() . '/js/min/glightbox/glightbox.min.js', array(), $theme_version );

    //Splide
    wp_register_script('splide', get_template_directory_uri() . '/js/min/splide/splide.min.js', array(), $theme_version );

////TEMPLATES