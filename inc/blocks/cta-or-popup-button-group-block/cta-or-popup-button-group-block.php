<?php
    
    //empty variable
    $AddIcon = "";

    //Field Preface
    $FieldPreface = "cta_or_popup_button_group_block-";

    /*classes*/
    $className = 'ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    //$BlockAlignment
    $BlockAlignment = "";
    $AlignmentChoice = get_field($FieldPreface  . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

?>

<!--ENButtonGroupBlock-->
<div class="ThemeButtonGroup <?php echo $className; ?> <?php echo $BlockAlignment; ?>">
<?php if( have_rows($FieldPreface . '_buttons') ):?>
    <?php while( have_rows($FieldPreface . '_buttons') ) : the_row();?>
    <?php
        /*Empty Variables*/
        $ThemeButtonNewPage = "";
        $ThemeButtonHREF = "";
        $ButtonStyles = "";
        $AddArrow = "";

        //Link Array
        $LinkArray = get_sub_field($FieldPreface . '_link_&_text');

        $ButtonType = get_sub_field($FieldPreface . '_button_type');

        if($ButtonType == "popup"){
            $ThemeButtonText = get_sub_field($FieldPreface . '_button_text');
            $ThemeButtonID = get_sub_field($FieldPreface . '_popup_id');
        }
        elseif($ButtonType == "download"){
            $ThemeButtonText = get_sub_field($FieldPreface . '_button_text');
            $ThemeButtonHREF = 'href="' . esc_url( get_sub_field($FieldPreface . '_download_file') ) . '" download';
        }
        else{
            $LinkArray = get_acf_link_elements($LinkArray);
            $ThemeButtonHREF = $LinkArray['link-href'];
            $ThemeButtonText = $LinkArray['link-text'];
            $ThemeButtonNewPage = $LinkArray['link-target'];
        }
        $ThemeButtonText = strip_tags($ThemeButtonText);

        //Button Styles
        //Button Padding & Radius
        $ButtonPaddingTB = get_sub_field($FieldPreface . '_padding_top_and_bottom');
        $ButtonPaddingLR = get_sub_field($FieldPreface . '_padding_left_and_right');
        $ButtonPadding = "padding: ". $ButtonPaddingTB . "px " . $ButtonPaddingLR . "px " . $ButtonPaddingTB . "px " . $ButtonPaddingLR . "px; ";

        $ButtonStyles = $ButtonPadding ;

        //Button Colour
        $ButtonColourSelection = get_sub_field($FieldPreface . '_button_colour');


    ?>
        <?php if($ButtonType == "popup"): ?>
        <button style="<?php echo $ButtonStyles; ?>" class="ThemeButton background <?php echo $ButtonColourSelection; ?>" data-bs-toggle="modal" data-bs-target="#<?php echo $ThemeButtonID; ?>">
            <?php echo $ThemeButtonText; ?>
        </button>
        <?php elseif($ButtonType == "download"): ?>
        <a style="<?php echo $ButtonStyles; ?>" class="ThemeButton background <?php echo $ButtonColourSelection; ?>" <?php echo $ThemeButtonHREF; ?>>
            <?php echo $ThemeButtonText; ?>
        </a>
        <?php else: ?>
        <a style="<?php echo $ButtonStyles; ?>" class="ThemeButton background <?php echo  $ButtonColourSelection; ?>" <?php echo $ThemeButtonHREF; ?> <?php echo $ThemeButtonNewPage; ?>>
            <?php echo $ThemeButtonText; ?>
        </a>
        <?php endif; ?>
    <?php endwhile; ?>
<?php else:?>
    <p>
        CTA Button Group Block
    </p>
<?php endif; ?>
</div>