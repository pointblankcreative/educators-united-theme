<?php

    //Field Preface
    $FieldPreface = "post_share_buttons-";

    /*classes*/
    $className = 'ShareButtons ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    //$BlockAlignment
    $AlignmentChoice = get_field($FieldPreface  . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';


    /*Empty Variables*/
    $FacebookShareLink = "";
    $TwitterShareLink = "";
    $URL = "";

    $URLBool = get_field($FieldPreface . '_use_custom_link');
    if($URLBool){
        $URL = get_field($FieldPreface . '_custom_link');
    }
    else{
        global $wp;
        $URL = home_url( $wp->request );
    }

    $FacebookShareLink = 'href="https://www.facebook.com/sharer/sharer.php?u=' . $URL . '"';

    $TwitterMessage = urlencode(get_field($FieldPreface . '_twitter_message'));
    $TwitterShareLink = 'href="https://twitter.com/share?text=' . $TwitterMessage . '&url=' . $URL . '"';
        
    
?>
<div class="<?php echo $className; ?> <?php echo $BlockAlignment; ?>">

    <a class="ThemeButton background primary" <?php echo $FacebookShareLink; ?> title="Share on Facebook" target="_blank">
        <i class="fa-brands fa-facebook-f pe-2"></i>
        Share on Facebook
    </a>
    <a class="ThemeButton background primary" <?php echo $TwitterShareLink; ?> title="Share on Twitter" target="_blank">
        <i class="fa-brands fa-x-twitter pe-2"></i>
        Share on Twitter
    </a>
    
</div>