<?php

    wp_enqueue_style("scroll_animation_library");
    wp_enqueue_style("scroll_animation_library_start");

    //Field Preface
    $FieldPreface = "scroll_into_view_container-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //empty variables
    $ScrollAnimationMarkup = "";
    $AnimateOnce = "";

    if(!is_admin()){
        $ScrollAnimation = get_field($FieldPreface . "_animation");
        if($ScrollAnimation == ""){
            $ScrollAnimation = 'fade-up';
        }
        $ScrollAnimationMarkup = "data-aos='" . $ScrollAnimation . "'";

        $ScrollAnimationDelay = get_field($FieldPreface . "_animation_delay");
        if($ScrollAnimationDelay != ""){
            $ScrollAnimationMarkup .= " data-aos-delay='" . $ScrollAnimationDelay . "'";
        }
    }

    $AnimateOnceBool = get_field($FieldPreface . "_animate_only_once");
    if($AnimateOnceBool){
        $AnimateOnce = "data-aos-once='true'";
    }

?>
<div class="ScrollIntoViewContainer <?php echo $classes; ?>" <?php echo $ScrollAnimationMarkup; ?> <?php echo $AnimateOnce; ?>>
    <?php if(is_admin()):?>
    <div>
        <span class="badge bg-primary">
            Scroll Into View Container Block
        </span>
    </div>
    <?php endif; ?>
    <div>
        <InnerBlocks />
    </div>
</div>