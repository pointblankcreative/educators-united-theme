<?php

    wp_enqueue_style("form_container_block");
    wp_enqueue_script( 'side_widget');

    //Field Preface
    $FieldPreface = "form_container_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = 'ContainerBlock FormContainerBlock';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    $ContainerID = "";
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
        $ContainerID = "id='" . $id . "'";
    }

    //_form_mobile_order
    $FormMobileOrder = get_field($FieldPreface . "_form_mobile_order");
    if($FormMobileOrder == ""){
        $FormMobileOrder == "flex-column-reverse";
    }
        //AfterContentInMobile
        //BeforeContentInMobile

    //Empty Variables
    $BackgroundStyle = "";
    $ExtraClass = "";
    $GradientOverlay = "";

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

    if(!is_admin()){
        $FormType = get_field($FieldPreface . "_form_type");
        $FormTitle = get_field($FieldPreface . "_form_title");
    }

?>
<div style="<?php echo $GradientOverlay; ?>">
    <div <?php echo $ContainerID; ?> class="<?php echo $ExtraClass; ?>" style="<?php echo $Margin; ?> <?php echo $BackgroundStyle; ?>">
        <div class="container <?php echo esc_attr($classes); ?>">
            <div class="row <?php echo $FormMobileOrder; ?> flex-md-row-reverse">
                <div class="col-12 col-md-6 col-lg-5">
                    <?php if(is_admin()) :?>
                        Form will appear here on frontend of website.
                    <?php else: ?>
                        <div id="Form" class="FormSection">
                            <div class="PageWidgetInner FormInnerContainer">
                                <div class="PageWidgetContainer">
                                    <?php if($FormTitle != ""): ?>
                                    <div>
                                        <?php echo $FormTitle; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($FormType == "shortcode"): ?>
                                        <?php
                                            $FormShortcode = get_field($FieldPreface . "_form_shortcode");
                                        ?>
                                        <div>
                                            <?php echo do_shortcode($FormShortcode); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($FormType == "embed"): ?>
                                        <?php
                                            $FormEmbed = get_field($FieldPreface . "_form_embed");
                                            if($FormEmbed != ""){
                                                        
                                                //This removed Action Networks styling in case the user adds it.
                                                $pattern = '/<link\s+[^>]*href=[\'"][^\'"]+\.css[\'"][^>]*>/i';
                                            
                                                // Use preg_replace to remove the <link> element
                                                $FormEmbed = preg_replace($pattern, '', $FormEmbed);
                                                
                                            }
                                        ?>
                                        <div>
                                            <?php echo $FormEmbed; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="FormInnerContainer" style="<?php echo $Padding; ?>">
                        <?php if(is_admin()):?>
                            <div>
                                <span class="badge bg-primary">
                                    Form Container Block
                                </span>
                            </div>
                        <?php endif; ?>
                        <InnerBlocks  />  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>