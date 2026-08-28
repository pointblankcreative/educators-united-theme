<?php

    //Field Preface
    $FieldPreface = "custom_image_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //empty variables
    $BlockAlignment = "";
    $ImageLinkBool = "";
    $ImageLink = "";
    $ImageLinkOpenNewPage = "";
    $HoverAnimation = "";
    $ImageWidth = "width: 100%;";
    $CaptionBool = "";
    $ImageCaption = "";
    $CaptionColour = "";
    $CaptionPosition = "";

    //Get Image
    $Image = get_field($FieldPreface . '_image');
    if($Image != ""){
        $CaptionBool = get_field($FieldPreface . "_add_caption");
        if($CaptionBool){
            $ImageCaption = esc_attr($Image['caption']);
            $CaptionColour = get_field($FieldPreface . "_caption_colour");
            if($CaptionColour == ""){
                $CaptionColour = "#000";
            }
            $CaptionPosition = get_field($FieldPreface . "_caption_position");
            if($CaptionPosition == ""){
                $CaptionPosition = "text-start";
            }
        }
    }
    
    $Image = get_image_and_alt($Image);
    $ImageSRC = $Image['src'];
    $ImageAlt = $Image['alt'];

    //Add Max Width Bool
    $ImageMaxWidthBool = get_field($FieldPreface . '_add_max_width');
    if($ImageMaxWidthBool){

        $ImageWidth = "width: " . get_field($FieldPreface . '_max_width') . "px;";

        //$BlockAlignment
        $DesktopAlignmentClass = "";
        $TabletAlignmentClass = "";
        $MobileAlignmentClass = "";
        $BlockAlignment = "d-flex ";

        $AlignmentChoice = get_field($FieldPreface . '_adjust_view_alignment');

        include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';

    }

    //Link Bool

    $ImageLinkBool = get_field($FieldPreface . '_add_link');
    if($ImageLinkBool){

        $HoverAnimationBool = get_field($FieldPreface . '_add_hover_animation');
        if($HoverAnimationBool){
            $HoverAnimation = "class='BiggerHover'";
        }
        if(!is_admin()){
            $ImageLink = get_field($FieldPreface . '_link');
            $ImageLinkOpenNewPageBool = get_field($FieldPreface . '_open_new_page');
            if($ImageLinkOpenNewPageBool){
                $ImageLinkOpenNewPage = "target='_blank'";
            }
        }

    }
    

    //_turn_image_into_circle
    $CircleImageBool = get_field($FieldPreface . "_turn_image_into_circle");
    if($CircleImageBool){
        $classes .= sprintf( ' %s', "CircleImage" );
    }


?>
<?php if(is_admin()):?>
<div>
    <p> 
        <span class='badge bg-success'>
            Theme Image Block
        </span> 
    </p>
</div>
<?php endif; ?>
<div class="ThemeImageBlock <?php echo $classes; ?> <?php echo $BlockAlignment; ?>">
        <?php if(!is_admin()):?>
        <?php if($ImageLinkBool):?>
        <a href="<?php echo $ImageLink; ?>" <?php echo $ImageLinkOpenNewPage; ?>>    
        <?php endif; ?>
        <?php endif; ?>
        <figure <?php echo $HoverAnimation; ?>>
            <img class="img-fluid " src="<?php echo $ImageSRC; ?>" alt="<?php echo $ImageAlt; ?>" style="<?php echo $ImageWidth; ?>" />
            <?php if($CaptionBool): ?>
                <figcaption class="<?php echo $CaptionPosition; ?> my-3" style="color:<?php echo $CaptionColour; ?> !important;"><?php echo $ImageCaption; ?></figcaption>
            <?php endif; ?>
        </figure>
        <?php if(!is_admin()):?>
        <?php if($ImageLinkBool):?>
        </a>    
        <?php endif; ?>
        <?php endif; ?>
</div>