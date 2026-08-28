<?php

    //Field Preface
    $FieldPreface = "cta_button_block-";

    /*Empty Variables*/
    $ButtonHREF = "";
    $ButtonText = "";
    $ButtonTarget = "";
    $ButtonStyleSelection = "";
    $Download = "";

    /*classes*/
    $className = 'ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    //$BlockAlignment
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $BlockAlignment = "d-flex ";

    $AlignmentChoice = get_field($FieldPreface  . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

    $ButtonType = get_field($FieldPreface . '_button_type');
    if($ButtonType == ""){
        $ButtonType = "link";
    }

    switch ($ButtonType) {
        case "download":

            $ButtonText = get_field($FieldPreface . '_button_text');
            if($ButtonText == ""){
                $ButtonText = "Placeholder Text";
            }

            if(!is_admin()){
                $ButtonHREF = get_field($FieldPreface . '_file_link');
                $ButtonHREF = "href='" . $ButtonHREF . "'";
                $Download = "download";
            }
    
            break;
            
        default:

            $LinkArray = get_field($FieldPreface . '_link_text');

            $LinkArray = get_acf_link_elements($LinkArray);
            $ButtonText = $LinkArray['link-text'];
            $ButtonHREF = $LinkArray['link-href'];
            $ButtonTarget = $LinkArray['link-target'];
    
            break;
    
    }

    //Button Colours
    $ButtonStyleSelection = get_field($FieldPreface . '_button_colour');
    if($ButtonStyleSelection == ""){
        $ButtonStyleSelection = "dark";
    }

?>
<!--CTAButtonBlock-->
<div class="<?php echo $className; ?> <?php echo $BlockAlignment; ?>">
    <a class="ThemeButton background <?php echo $ButtonStyleSelection; ?>" <?php echo $ButtonHREF; ?> <?php echo $ButtonTarget; ?> <?php echo $Download; ?>>
        <?php echo $ButtonText; ?>
    </a>
</div>