<?php

    wp_enqueue_style("social_media_buttons");

    //Field Preface
    $FieldPreface = "social_media_buttons-";
    $FieldPreface2 = "social_media_icon-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //Empty and Default Variables
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $BlockAlignment = "d-flex ";
    $ButtonColour = "";

    $AlignmentChoice = get_field($FieldPreface . '_adjust_view_alignment');

    $ButtonColour = get_field($FieldPreface . "_button_colour");
    if($ButtonColour == ""){
        $ButtonColour = "light";
    }

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';



?>
<?php if( have_rows('social_media_buttons') ): ?>
<div class="d-flex SocialButtons ThemeButtonWrapper <?php echo $BlockAlignment; ?> <?php echo $classes; ?>">
<?php while( have_rows('social_media_buttons') ) : the_row(); ?>
<?php
    //empty variables
    $SocialMediaButtonMarkup = "";
    
    $SocialMediaButtonType = get_sub_field($FieldPreface2 . '_button_type');

    if(!is_admin()){
        switch ($SocialMediaButtonType ) {

            case "Email":
                $SocialMediaIconLinkPageBool = get_sub_field($FieldPreface2 . '_email_or_page_link');
                if($SocialMediaIconLinkPageBool == "Email"){
                    $SocialMediaIconEmail = get_sub_field($FieldPreface2 . '_email_address');

                    $SocialMediaButtonMarkup = 'href="mailto:'. $SocialMediaIconEmail .'"';
                }
                else{
                    $SocialMediaIconLink = get_sub_field($FieldPreface2 . '_link');
                    $SocialMediaButtonMarkup = 'href="'. $SocialMediaIconLink .'" target="_blank"';
                }
        
                break;
        
            case "Phone":

                $SocialMediaIconPhone = get_sub_field($FieldPreface2 . '_phone_number');
                $SocialMediaButtonMarkup = 'href="tel:'. $SocialMediaIconPhone .'"';
        
                break;
        
            default:

                $SocialMediaIconLink = get_sub_field($FieldPreface2 . '_link');
                $SocialMediaButtonMarkup = 'href="'. $SocialMediaIconLink .'" target="_blank"';
        
                break;
        }
    }
?>
    <a class="ThemeButton background <?php echo $SocialMediaButtonType; ?> <?php echo $ButtonColour; ?> " title="<?php echo $SocialMediaButtonType; ?>" <?php echo $SocialMediaButtonMarkup; ?>>
    </a>
<?php endwhile; ?>
</div>
<?php else: ?>
<div class="d-flex SocialButtons ThemeButtonWrapper <?php echo $BlockAlignment; ?> <?php echo $classes; ?>">
    <a class="Facebook ThemeButton background primary light" title="Placeholder">
    </a>
</div>
<?php endif; ?>