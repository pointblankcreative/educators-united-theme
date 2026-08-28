<?php
////GLOBALS
    //Global Placeholder
    require get_template_directory() . "/inc/globals/global_placeholder.php";

    //Editor colours (Gutenberg, TinyMCE, ACF colour picker)
    require get_template_directory() . "/inc/globals/global_editor_colours.php";

////FUNCTIONS
    //convert_phone_number_to_href
    require get_template_directory() . "/inc/functions/convert_phone_number_to_href.php";

    //get_image_and_alt
    require get_template_directory() . "/inc/functions/get_image_and_alt.php";

    //remove spaces and special characters
    require get_template_directory() . "/inc/functions/remove_spaces_and_special_characters.php";

    //remove spaces
    require get_template_directory() . "/inc/functions/remove_spaces.php";

    //strip tags but allow bold, italics, and line break tags
    require get_template_directory() . "/inc/functions/strip_tags_allow_bold_break_italics.php";

    //strip tags line break tags
    require get_template_directory() . "/inc/functions/strip_tags_allow_breaks.php";

    //turn_link_to_href
    require get_template_directory() . "/inc/functions/turn_link_to_href.php";

    //Validate colour string
    require get_template_directory() . "/inc/functions/validate_colour_string.php";

    //Get random  ID
    require get_template_directory() . "/inc/functions/get_random_id.php";

    //get_acf_link_elements
    require get_template_directory() . "/inc/functions/get_acf_link_elements.php";

///THEME SETUP
    //ACF Custom Blocks
    require get_template_directory() . "/inc/theme_setup/acf_custom_blocks.php";

    //add default colours to specified options pages
    require get_template_directory() . "/inc/theme_setup/acf_options_colours.php";

    //Enqueue Stylesheets and JS files
    require get_template_directory() . "/inc/theme_setup/enqueue_stylesheets_and_js.php";

    //Add New Gutenberg Category for ACFP Blocks
    require get_template_directory() . "/inc/theme_setup/gutenberg_custom_block_categories.php";

    //Add Custom Stylesheets to Gutenberg Editor so that Customblocks load correctly
    require get_template_directory() . "/inc/theme_setup/gutenberg_editor_additional_stylesheets.php";

    //Install and activate plugins
    require get_template_directory() . "/inc/theme_setup/install_activate_plugins.php";

    //Remove Posts and Menus from admin
    require get_template_directory() . "/inc/theme_setup/remove_admin_menu_items.php";

    //Remove default placeholder content (Hello World, Sample Page) on theme activation
    require get_template_directory() . "/inc/theme_setup/remove_default_content.php";

    //Disable comments site-wide
    require get_template_directory() . "/inc/theme_setup/disable_comments.php";

    //language_toggler
    require get_template_directory() . "/inc/theme_setup/language_toggler.php";

    //Register Stylesheets and JS files
    require get_template_directory() . "/inc/theme_setup/register_stylesheets_and_js.php";

    //Remove Auto P from Contact Form 7
    //require get_template_directory() . "/inc/theme_setup/remove_autop_from_contact_form_7.php";

    //Default Template for Pages & Posts
    require get_template_directory() . "/inc/theme_setup/new_page_default_blocks.php";

    //menu_locations.php
    require get_template_directory() . "/inc/theme_setup/menu_locations.php";

    // Primary menu CTA class (ACF true/false adds CTANavButton to menu item)
    require get_template_directory() . "/inc/theme_setup/primary_menu_cta_class.php";

    //Enqueue Theme Supports & Mods
    require get_template_directory() . "/inc/theme_setup/theme_supports.php";

    //Footer Widget
    require get_template_directory() . "/inc/theme_setup/widgets.php";

    //disable_blocks
    require get_template_directory() . "/inc/theme_setup/disable_blocks.php";


////OPTION PAGES
    //ACF Add Options Pages
    require get_template_directory() . "/inc/options/acf_options.php";

////PATTERNS
    // Test Font Sizes and CTA Button Block (Gutenberg pattern)
    require get_template_directory() . "/inc/patterns/test-font-sizes-and-cta-button-block.php";

////TEMP DEBUG
    add_action('rest_api_init', function(){
        register_rest_route('debugtmp/v1', '/templates', array(
            'methods' => 'GET',
            'callback' => function(){
                return array(
                    'theme' => wp_get_theme()->get_stylesheet(),
                    'templates' => wp_get_theme()->get_page_templates(),
                );
            },
            'permission_callback' => '__return_true',
        ));
    });