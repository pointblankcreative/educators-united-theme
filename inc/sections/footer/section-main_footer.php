<?php
    $FooterFieldPreface = "footer_controls-";
    $SocialsFieldPreface = "social_media_buttons_controls-";

    $FooterOpeningTag = "figure";
    $FooterClosingTag = "/figure";

    $SocialMediaBool = false;

    $FooterLogo = get_field($FooterFieldPreface . "_footer_logo", "options");
    if($FooterLogo){
        $FooterLogo = get_image_and_alt($FooterLogo);
        $FooterLogoSRC = $FooterLogo['src'];
        $FooterLogoAlt = $FooterLogo['alt'];
        $LogoClass = "HasLogo";

        //_footer_url
        $FooterURL = get_field($FooterFieldPreface . "_footer_url", "options");
        if($FooterURL != ""){
            $FooterTarget = "";
            $FooterURL = turn_link_to_href($FooterURL);
            $FooterOpeningTag = "a " . $FooterURL;
            $FooterClosingTag = "/a";
            $FooterTargetBool = get_field($FooterFieldPreface . "_footer_url_open_new_tab", "options");
            if($FooterTargetBool){
                $FooterTarget = "target='_blank'";
                $FooterOpeningTag = $FooterOpeningTag . " " . $FooterTarget;
            }
        }
    }

    //_footer_description_text
    $FooterDescription = get_field($FooterFieldPreface . "_footer_description_text", "options");

    //_footer_background_colour
    $FooterBackgroundColour = get_field($FooterFieldPreface . "_footer_background_colour", "options");
    if($FooterBackgroundColour == ""){
        $FooterBackgroundColour = "#000000";
    }

    $locations = get_nav_menu_locations();
    $footer_menu_id = isset($locations['footer-menu']) ? $locations['footer-menu'] : 0;
    $footer_menu_items = $footer_menu_id ? wp_get_nav_menu_items($footer_menu_id) : array();

    if( have_rows($SocialsFieldPreface . "_social_media_buttons", "options") ){
        wp_enqueue_style("social_media_buttons");
        $SocialMediaBool = true;
        //_footer_social_button_colour
        $ButtonColour = get_field($FooterFieldPreface . "_footer_social_button_colours", "options");
        if($ButtonColour == ""){
            $ButtonColour = "light";
        }
    }


?>
<footer style="background: <?php echo $FooterBackgroundColour; ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4">
                <<?php echo $FooterOpeningTag; ?>>
                    <img class="img-fluid w-100 FooterLogo" src="<?php echo $FooterLogoSRC; ?>" alt="<?php echo $FooterLogoAlt; ?>">
                <<?php echo $FooterClosingTag; ?>>
                <?php if($FooterDescription != "") :?>
                    <?php echo $FooterDescription; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6 col-lg-8">

                <?php if( $SocialMediaBool == true): ?>
                    <div class="d-flex SocialButtons ThemeButtonWrapper justify-content-start justify-content-md-end flex-wrap my-4">
                        <?php while( have_rows($SocialsFieldPreface . "_social_media_buttons", "options") ) : the_row(); ?>
                        <?php
                            //empty variables
                            $SocialMediaButtonMarkup = "";
                            
                            $SocialMediaButtonType = get_sub_field($SocialsFieldPreface . '_social_media_button_type', "options");
                            
                            switch ($SocialMediaButtonType ) {

                                case "Email":
                                    $SocialMediaIconLinkPageBool = get_sub_field($SocialsFieldPreface . '_email_or_page_link', "options");
                                    if($SocialMediaIconLinkPageBool == "Email"){
                                        $SocialMediaIconEmail = get_sub_field($SocialsFieldPreface . '_email_address', "options");

                                        $SocialMediaButtonMarkup = 'href="mailto:'. $SocialMediaIconEmail .'"';
                                    }
                                    else{
                                        $SocialMediaIconLink = get_sub_field($SocialsFieldPreface . '_link', "options");
                                        $SocialMediaButtonMarkup = 'href="'. $SocialMediaIconLink .'" target="_blank"';
                                    }
                            
                                    break;
                            
                                case "Phone":

                                    $SocialMediaIconPhone = get_sub_field($SocialsFieldPreface . '_phone_number', "options");
                                    $SocialMediaButtonMarkup = 'href="tel:'. $SocialMediaIconPhone .'"';
                            
                                    break;
                            
                                default:

                                    $SocialMediaIconLink = get_sub_field($SocialsFieldPreface . '_link', "options");
                                    $SocialMediaButtonMarkup = 'href="'. $SocialMediaIconLink .'" target="_blank"';
                            
                                    break;
                            }
                            
                        ?>
                            <a class="ThemeButton background <?php echo $SocialMediaButtonType; ?> <?php echo $ButtonColour; ?> " title="<?php echo $SocialMediaButtonType; ?>" <?php echo $SocialMediaButtonMarkup; ?>>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php
                    if (has_nav_menu('footer-menu') && is_array($footer_menu_items) && !empty($footer_menu_items)) :
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'     => 'FooterMenu',
                            'container'      => 'nav',
                            'container_class'=> '',
                        ));
                    endif;
                ?>
                <p class="text-center text-md-end"><?php echo date("Y"); ?> @ OrgNameHere</p>
            </div>
        </div>
    </div>
</footer>