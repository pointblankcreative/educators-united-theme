<?php
    /*Empty Variables*/
    $ModalButtonNewPage = "";
    $ModalButtonHREF = "";
    $ModalButtonID = "";
    $BlockAlignment = "";

    //Field Preface
    $FieldPreface = "popup_button_block-";

    /*classes*/
    $className = 'ThemeButtonWrapper';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    //$BlockAlignment

    $AlignmentChoice = get_field($FieldPreface . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

    /*Modal Text*/
    $ModalButtonText = get_field($FieldPreface  . '_text');
    if(empty($ModalButtonText)){
        $ModalButtonText = 'Placeholder text';
    }
    $ModalButtonText = strip_tags($ModalButtonText);

    /*Modal Link*/
    if(!is_admin()){
        $ModalButtonID = get_field($FieldPreface  . '_popup_id');
    }

    //Button Styles
    //Button Padding & Radius
    $ButtonPaddingTB = get_field($FieldPreface . '_padding_top_and_bottom');
    $ButtonPaddingLR = get_field($FieldPreface . '_padding_left_and_right');
    $ButtonPadding = "padding: ". $ButtonPaddingTB . "px " . $ButtonPaddingLR . "px " . $ButtonPaddingTB . "px " . $ButtonPaddingLR . "px; ";
    $ButtonStyles = $ButtonPadding;

    //Button Colours
    $ButtonStyleSelection = get_field($FieldPreface . '_button_style');
    $ButtonColourSelection = get_field($FieldPreface . '_button_colour');

?>
<div class="<?php echo $className; ?> <?php echo $BlockAlignment; ?>">
    <button style="<?php echo $ButtonStyles; ?>" class="ThemeButton background <?php echo $ButtonColourSelection; ?>" data-bs-toggle="modal" data-bs-target="#<?php echo $ModalButtonID; ?>">
        <?php echo $ModalButtonText; ?>
    </button>
</div>