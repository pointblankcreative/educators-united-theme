<?php

    wp_enqueue_style("container");

    //Field Preface
    $FieldPreface = "container-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = 'ContainerBlock';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    $ContainerID = "";
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
        $ContainerID = "id='" . $id . "'";
    }

    //Empty Variables
    $BackgroundStyle = "";
    $ExtraClass = "";
    $GradientOverlay = "";

    //_update_container_min_height
    $ContainerMinHeightBool = get_field($FieldPreface . "_update_container_min_height");
    if($ContainerMinHeightBool){
        $ContainerMinHeight = get_field($FieldPreface . "_container_min_height");
        $classes .= sprintf( ' %s', $ContainerMinHeight );
    }

    // Load custom field values
    //padding
    $PaddingTop = get_field($FieldPreface . "_padding_top");
    if($PaddingTop == ""){
        $PaddingTop = 5;
    }
    $PaddingRight = get_field($FieldPreface . "_padding_right");
    if($PaddingRight == ""){
        $PaddingRight = 0;
    }
    $PaddingBottom = get_field($FieldPreface . "_padding_bottom");
    if($PaddingBottom == ""){
        $PaddingBottom = 5;
    }
    $PaddingLeft = get_field($FieldPreface . "_padding_left");
    if($PaddingLeft == ""){
        $PaddingLeft = 0;
    }

    $Padding = "padding:" . $PaddingTop . "px " . $PaddingRight . "px " . $PaddingBottom . "px " . $PaddingLeft . "px; ";

    //Margin
    $MarginTop = get_field($FieldPreface . '_margin_top');
    if($MarginTop == ""){
        $MarginTop = 0;
    }
    $MarginBottom = get_field($FieldPreface . '_margin_bottom');
    if($MarginBottom == ""){
        $MarginBottom = 0;
    }
    $Margin = "margin: " . $MarginTop . "px 0 " . $MarginBottom . "px 0;";

    //Background
    $BackgroundOption = get_field($FieldPreface . '_background_options');

    //Background switch statements?
    switch ($BackgroundOption) {
        case "color":
            $BackgroundColour = get_field($FieldPreface . '_background_color');
            $BackgroundColour = validateColourString($BackgroundColour);
            $BackgroundStyle = "background-color: ". $BackgroundColour .";";
            break;
        case "gradient":

            $GradientColours = "";
            $Row = 1;
            if( have_rows($FieldPreface . "_gradient_colours") ){
                $RowCount = count(get_field($FieldPreface . "_gradient_colours"));
                while( have_rows($FieldPreface . "_gradient_colours") ) {
                    the_row();
                    $GradientColour = get_sub_field($FieldPreface . "_gradient_colour");
                    $GradientColour = validateColourString($GradientColour);
                    switch ($Row) {
                        case $RowCount:
                            $GradientColours .= $GradientColour;
                            break;
                        default:
                            $GradientColours .= $GradientColour . ", ";
                            break;
                    }
                    $Row = $Row + 1;
                } 
            }

            $GradientDirection = get_field($FieldPreface . '_gradient_color_direction');

            $BackgroundStyle = "background: linear-gradient(" . $GradientDirection . ", ". $GradientColours .");";

            break;

        case "background_image":
            $BackgroundPosition = "";
            $BackgroundImageOverlay = "";

            $BackgroundImage = get_field($FieldPreface . '_background_image');
            if($BackgroundImage != ""){
                $BackgroundImageURL = $BackgroundImage['url'];
            }
            else{
                $BackgroundImageURL = "";
            }

            $BackgroundImageRepeat = get_field($FieldPreface . '_background_image_repeat');
            $BackgroundImageRepeatStyle = "background-repeat: " . $BackgroundImageRepeat . "; ";

            if($BackgroundImageRepeat === "no-repeat"){
                $BackgroundSize2 = get_field($FieldPreface . '_background_image_size_2');
                $BackgroundHorizontalPosition = get_field($FieldPreface . '_background_image_horizontal_position');
                $BackgroundVerticalPosition = get_field($FieldPreface . '_background_image_vertical_position');
                $BackgroundPosition = "background-position: " . $BackgroundVerticalPosition . ", " . $BackgroundHorizontalPosition . "; ";
                if ($BackgroundSize2 == "parallax"){
                    $BackgroundPosition .= "background-size: cover;";
                    $ExtraClass .= "  ParallaxClass  ";
                }
                else{
                    $BackgroundPosition .= "background-size: ". $BackgroundSize2 ."; ";
                }
            }
            else{
                $BackgroundSize1 = get_field($FieldPreface . '_background_image_size_1') . "px; ";
                $BackgroundPosition = "background-size: ". $BackgroundSize1 ."; "; 
            }

            $BackgroundOverlayBool = get_field($FieldPreface . '_background_image_color_overlay');
            switch ($BackgroundOverlayBool) {
                case "colour":
                    $BackgroundColour = get_field($FieldPreface . '_background_color');
                    $BackgroundColour = validateColourString($BackgroundColour);
                    $BackgroundImageOverlay = "background-color: ". $BackgroundColour .";";
                    $ExtraClass .= ' overlay-class ';
                    break;
                case "gradient":
                    $GradientColours = "";
                    $Row = 1;
                    if( have_rows($FieldPreface . "_gradient_colours") ){
                        $RowCount = count(get_field($FieldPreface . "_gradient_colours"));
                        while( have_rows($FieldPreface . "_gradient_colours") ) {
                            the_row();
                            $GradientColour = get_sub_field($FieldPreface . "_gradient_colour");
                            $GradientColour = validateColourString($GradientColour);
                            //$GradientColour = hexToRgba($GradientColour, 0.3);
                            switch ($Row) {
                                case $RowCount:
                                    $GradientColours .= $GradientColour;
                                    break;
                                default:
                                    $GradientColours .= $GradientColour . ", ";
                                    break;
                            }
                            $Row = $Row + 1;
                        } 
                    }
        
                    $GradientDirection = get_field($FieldPreface . '_gradient_color_direction');
        
                    $GradientOverlay = "background: linear-gradient(" . $GradientDirection . ", ". $GradientColours .");";
                    $ExtraClass .= ' overlay-class ';
                    break;
                default:
                    //do nothing
                    break;
            }


            $BackgroundStyle = $BackgroundImageOverlay . $BackgroundImageRepeatStyle . $BackgroundPosition . 'background-image: url(' . $BackgroundImageURL . '); ';

            break;
        default:
        //Do Nothing
    }

    $ContainerWidth = get_field($FieldPreface . "_width");
    if($ContainerWidth == "ExtraWide"){
        $classes .= sprintf( ' %s', "ExtraWide" );
    }


?>
<div style="<?php echo $GradientOverlay; ?>">
    <div <?php echo $ContainerID; ?> class="<?php echo $ExtraClass; ?>" style="<?php echo $Margin; ?> <?php echo $BackgroundStyle; ?>">
    
        <div class="container <?php echo esc_attr($classes); ?>">
            <div class="row" style="<?php echo $Padding; ?>">
                <?php if(is_admin()):?>
                <div>
                    <span class="badge bg-primary">
                        Container Block
                    </span>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <InnerBlocks  />  
                </div>
            </div>
        </div>
    </div>
</div>