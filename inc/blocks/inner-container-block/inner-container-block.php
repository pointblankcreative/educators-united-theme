<?php

    //Field Preface
    $FieldPreface = "inner_container_block-";

    //empty variables
    $BlockAlignment = "";
    $Padding = "";
    $BackgroundStyle = "";
    $BorderRadius = "";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = "MaxWidthContainer";
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //default value
    $Style = "width: 100%; ";

    //get max width value
    $MaxWidth = get_field($FieldPreface . "_max_width");
    if($MaxWidth != ""){
        $Style = "max-width:" . $MaxWidth . "px; width: 100%; ";
        
        $AlignmentChoice = get_field($FieldPreface . ':_adjust_view_alignment');
        include get_template_directory() . '/inc/block-alignment-options/alignment_options.php';
    }

    //padding
    $PaddingTop = get_field($FieldPreface . "_padding_top");
    $PaddingRight = get_field($FieldPreface . "_padding_right");
    $PaddingBottom = get_field($FieldPreface . "_padding_bottom");
    $PaddingLeft = get_field($FieldPreface . "_padding_left");

    if($PaddingTop != ""){
        $Padding = "padding:" . $PaddingTop . "px " . $PaddingRight . "px " . $PaddingBottom . "px " . $PaddingLeft . "px; ";
    }

    //Background
    $BackgroundOption = get_field($FieldPreface . '_background_options');

    //Background switch statements?
    switch ($BackgroundOption) {
        case "color":
            $BackgroundColour = get_field($FieldPreface . '_background_color');
            $BackgroundColour = validateColourString($BackgroundColour);
            $Style = $Style . " background-color:" . $BackgroundColour . "; ";
            break;
        default:
            //do nothing
            break;
    }

    //_add_border_radius
    $BorderRadiusBool = get_field($FieldPreface . "_add_border_radius");
    if($BorderRadiusBool){
        ////_border_top_left_radius
        $BorderTopLeft = get_field($FieldPreface . "_border_top_left_radius");
        if($BorderTopLeft == ""){
            $BorderTopLeft = 60;
        }

        ////_border_top_right_radius
        $BorderTopRight = get_field($FieldPreface . "_border_top_right_radius");
        if($BorderTopRight == ""){
            $BorderTopRight = 60;
        }

        ////_border_bottom_right_radius
        $BorderBottomRight = get_field($FieldPreface . "_border_bottom_right_radius");
        if($BorderBottomRight == ""){
            $BorderBottomRight = 0;
        }

        ////_border_bottom_left_radius
        $BorderBottomLeft = get_field($FieldPreface . "_border_bottom_left_radius");
        if($BorderBottomLeft == ""){
            $BorderBottomLeft = 0;
        }

        $BorderRadius = "border-radius: " . $BorderTopLeft . "px " . $BorderTopRight . "px " . $BorderBottomRight . "px " . $BorderBottomLeft . "px;";

    }
    
    $Style = $Style . " " . $Padding . " " . $BorderRadius;

    $BorderBool = get_field($FieldPreface . "_add_border");
    if($BorderBool){
        $BorderColour = get_field($FieldPreface . "_border_colour");
        $BorderColour = validateColourString($BorderColour);
        $BorderWidth = get_field($FieldPreface . "_border_width");
        $Style = $Style . "border: solid " . $BorderWidth . "px " . $BorderColour . "; ";
    }

    $Style = "style='". $Style ."'";

?>
<div class="<?php echo $classes; ?>">
    <?php if(is_admin()):?>
        <span class="badge bg-primary">
            Inner Container Block
        </span>
    <?php endif; ?>
    <div class="d-flex <?php echo $BlockAlignment; ?>">
        <div class="MaxWidthContainerInner" <?php echo $Style; ?> >
            <InnerBlocks  />
        </div>
    </div>
</div>