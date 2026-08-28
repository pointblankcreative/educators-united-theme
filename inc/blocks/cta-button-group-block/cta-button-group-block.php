<?php
    
    //empty variable
    $AddIcon = "";

    //Field Preface
    $FieldPreface = "cta_button_group_block-";

    /*classes*/
    $className = 'ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    //$BlockAlignment
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $BlockAlignment = "d-flex flex-wrap ";

    $AlignmentChoice = get_field($FieldPreface  . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

?>

<!--ENButtonGroupBlock-->
<div class="ThemeButtonGroup <?php echo $className; ?> <?php echo $BlockAlignment; ?>">
<?php if( have_rows($FieldPreface . '_buttons') ):?>
    <?php while( have_rows($FieldPreface . '_buttons') ) : the_row();?>
    <?php
        /*Empty Variables*/
        $ButtonHREF = "";
        $ButtonText = "";
        $ButtonTarget = "";
        $ButtonStyleSelection = "";
        $Download = "";

        $ButtonType = get_sub_field($FieldPreface . '_button_type');
        if($ButtonType == ""){
            $ButtonType = "link";
        }

        switch ($ButtonType) {
            case "download":

                $ButtonText = get_sub_field($FieldPreface . '_button_text');
                if($ButtonText == ""){
                    $ButtonText = "Placeholder Text";
                }

                if(!is_admin()){
                    $ButtonHREF = get_sub_field($FieldPreface . '_file_link');
                    $ButtonHREF = "href='" . $ButtonHREF . "'";
                    $Download = "download";
                }
        
                break;
                
            default:

                $LinkArray = get_sub_field($FieldPreface . '_link_text');

                $LinkArray = get_acf_link_elements($LinkArray);
                $ButtonText = $LinkArray['link-text'];
                $ButtonHREF = $LinkArray['link-href'];
                $ButtonTarget = $LinkArray['link-target'];
        
                break;
        
        }

        //Button Colour
        $ButtonStyleSelection = get_sub_field($FieldPreface . '_button_colour');
        if($ButtonStyleSelection == ""){
            $ButtonStyleSelection = "dark";
        }

    ?>
        <a class="ThemeButton background <?php echo  $ButtonStyleSelection; ?>" <?php echo $ButtonHREF; ?> <?php echo $ButtonTarget; ?> <?php echo $Download; ?>>
            <?php echo $ButtonText; ?>
        </a>
    <?php endwhile; ?>
<?php else:?>
    <p>
        CTA Button Group Block
    </p>
<?php endif; ?>
</div>