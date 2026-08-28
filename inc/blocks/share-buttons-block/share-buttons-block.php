<?php

    wp_enqueue_style("share_buttons");

    //Field Preface
    $FieldPreface = "share_buttons_block-";

    /*classes*/
    $className = 'ShareButtons ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    $lang = get_bloginfo("language");

    //$BlockAlignment
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $BlockAlignment = "d-flex ";

    $AlignmentChoice = get_field($FieldPreface  . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

    $ButtonColours = get_field($FieldPreface . "_button_colours");
    if($ButtonColours == ""){
        $ButtonColours = "primary";
    }

    $URL = "";

    if(!is_admin()){
        $URL = get_field($FieldPreface . '_share_link');
        if($URL == ""){
            global $wp;
            $URL = home_url( $wp->request );
        }
    }

    $lang = get_bloginfo("language");
        
?>
<?php if( have_rows($FieldPreface . "_share_buttons") ):?>
<div class="<?php echo $className; ?> <?php echo $BlockAlignment; ?>">
    <?php while( have_rows($FieldPreface . "_share_buttons") ) : the_row(); ?>
    <?php

        $ShareLink = "";

        $ShareButtonID = get_sub_field($FieldPreface . "_share_button_id");
        if($ShareButtonID != ""){
            $ShareButtonID = "id='" . $ShareButtonID . "'";
        }

        $SocialPlatform = get_sub_field($FieldPreface . "_social_platform");

        switch ($lang) {
            case "fr-FR":
                $ShareOn = "Partager Sur ";
                break;
            default:
                $ShareOn = "Share on ";
                break;
        }

        switch ($SocialPlatform) {
            case "facebook":
                $ShareIcon = "fa-brands fa-facebook-f";
                
                if(!is_admin()){
                    $ShareLink = 'href="https://www.facebook.com/sharer/sharer.php?u=' . $URL . '"';
                }
                $ShareOn = $ShareOn . "Facebook";
                break;
            case "x":
                $ShareIcon = "fa-brands fa-x-twitter";
                $ShareOn = $ShareOn . "X";
                if(!is_admin()){
                    $ShareMessage = get_sub_field($FieldPreface . '_share_message');
                    $ShareMessage = urlencode(stripTagsAllowBreaks($ShareMessage));
                    $ShareLink = 'href="https://twitter.com/share?text=' . $ShareMessage . '&url=' . $URL . '"';
                }
                break;
            case "instagram":
                $ShareIcon = "fa-brands fa-instagram";
                $ShareOn = $ShareOn . "Instagram";
                if(!is_admin()){
                    $InstagramPostLink = get_sub_field($FieldPreface . '_instagram_post_link');
                    $ShareLink = 'href="' . $InstagramPostLink . '"';
                }
                break;
            case "bluesky":
                $ShareIcon = "fa-brands fa-bluesky";
                $ShareOn = $ShareOn . "Bluesky";
                if(!is_admin()){
                    $ShareMessage = get_sub_field($FieldPreface . '_share_message');
                    $ShareMessage = urlencode(stripTagsAllowBreaks($ShareMessage));
                    $ShareLink = 'href="https://bsky.app/intent/compose?text=' . $ShareMessage . " " . $URL . '"';
                }
                break;
            case "whatsapp":
                $ShareIcon = "fa-brands fa-whatsapp";
                $ShareOn = $ShareOn . "WhatsApp";
                if(!is_admin()){
                    $ShareMessage = get_sub_field($FieldPreface . '_share_message');
                    $ShareMessage = urlencode(stripTagsAllowBreaks($ShareMessage));
                    $ShareLink = "href='https://api.whatsapp.com/send?text=" . $ShareMessage . " " . $URL . "'";
                }
                break;
            case "linkedin":
                $ShareIcon = "fa-brands fa-linkedin-in";
                $ShareOn = $ShareOn . "LinkedIn";
                if(!is_admin()){
                    $ShareLink = "href='https://www.linkedin.com/sharing/share-offsite/?url=" . $URL . "'";
                }
                break;
            case "email":
                $ShareIcon = "fa-solid fa-envelope";
                $ShareOn = $ShareOn . "Email";

                if(!is_admin()){
                    $ShareEmailMessage = get_sub_field($FieldPreface . '_email_message');

                    // Convert paragraphs to new lines
                    $ShareEmailMessage = preg_replace('/<\/p>\s*<p>/', "\n\n", $ShareEmailMessage);
                    
                    // Replace anchor tags with readable "Text (URL)" format
                    $ShareEmailMessage = preg_replace('/<a\s+href=["\'](.*?)["\'].*?>(.*?)<\/a>/', '$2 ($1)', $ShareEmailMessage);
                    
                    // Remove all other HTML tags
                    $ShareEmailMessage = strip_tags($ShareEmailMessage);
                    
                    // Encode for URL
                    $ShareEmailMessage = rawurlencode($ShareEmailMessage);
                    
                    $ShareEmailSubject = get_sub_field($FieldPreface . '_email_subject');
                    $ShareEmailSubject = rawurlencode($ShareEmailSubject);
                    
                    $ShareLink = 'href="mailto:?subject=' . $ShareEmailSubject . '&body=' . $ShareEmailMessage . '"';
                                     
                }
                break;
        }

    ?>
        <a <?php echo $ShareButtonID; ?> class="ThemeButton background <?php echo $ButtonColours; ?>" <?php echo $ShareLink; ?> target="_blank">
            <i class="<?php echo $ShareIcon; ?> pe-2"></i>
            <?php echo $ShareOn; ?>
        </a>
    <?php endwhile; ?>
</div>
<?php else: ?>
    <?php if(is_admin()): ?>
        <p>Add some share buttons.</p>
    <?php endif; ?>
<?php endif; ?>