<?php

    //Field Preface
    $FieldPreface = "embed_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = "";
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] ) . " ";
    }

    //$BlockAlignment
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $BlockAlignment = "d-flex ";

    $AlignmentChoice = get_field($FieldPreface . '_adjust_view_alignment');

    include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

    //empty variables
    $EmbedMaxWidth = "";
    $VideoEmbedClass = "";

    //Video Bool
    $VideoBool = true;

    //Random ID Generator
    $RandomID = "";

    //Video Title
    $VideoTitle = "";

    //width
    $EmbedWidth = "";

    $PlayButton = get_template_directory_uri() . "/images/video/PlayButton.png";

    $EmbedMaxWidth = get_field($FieldPreface . '_max_width');

    //if alignment exists, bring in max width
    if($EmbedMaxWidth  != ""){
        $EmbedWidth = "width:" . $EmbedMaxWidth . "px;";
        $EmbedMaxWidth = "max-width:" . $EmbedMaxWidth . "px; ";
    }
    else{
        $EmbedWidth = "width: 100%;";
    }

?>
<?php if(!is_admin()): ?>
    <?php
        include get_template_directory() . '/inc/blocks/embed-block/embed-block-partials/embed-block-frontend.php';
    ?>
<?php else: ?>
    <?php
        include get_template_directory() . '/inc/blocks/embed-block/embed-block-partials/embed-block-backend.php';
    ?> 
<?php endif; ?>