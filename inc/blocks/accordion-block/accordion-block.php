<?php
    wp_enqueue_style("accordion_block");

    $allowed_blocks = array( 'acf/accordion-item' );

    $FieldPreface = "accordion_block-";

    $AccordionID = get_field($FieldPreface . "_id");
    $AccordionID = strip_tags($AccordionID);
    $AccordionID = removeSpacesAndSpecialChars($AccordionID);

    $TabColours = get_field($FieldPreface . "_tab_colours");

?>
<div class="AccordionBlock">
    <?php if(is_admin()):?>
    <div class="row">
        <div class="col-12">
            <span class="badge bg-primary">
                Accordion Block
            </span>
        </div>
    </div>
    <?php endif; ?>
    <div class="accordion <?php echo $TabColours; ?>" id="<?php echo $AccordionID; ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
    </div>
</div>