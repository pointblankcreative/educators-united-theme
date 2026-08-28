<?php
    $my_block_template = array(
        array( "core/paragraph", array() )
    );

    $RandomID = get_random_id(4);

    $ShowClassButton = "collapsed";
    $ShowClassBody = "";

    $FieldPreface = "accordion_item-";

    $AccrdoionTitle = get_field($FieldPreface . "_title");
    $AccrdoionTitle = strip_tags($AccrdoionTitle);

    $ParentID = $context['acf/fields']['accordion_block-_id'];
    $ParentID = strip_tags($ParentID);
    $ParentID = removeSpacesAndSpecialChars($ParentID);

    $AccordionID = removeSpacesAndSpecialChars($AccrdoionTitle);
    $AccordionID = $AccordionID . $RandomID;

    $AccordionShow = get_field($FieldPreface . "_show_this_accordion_item");
    if($AccordionShow){
        $ShowClassBody = "show";
        $ShowClassButton = "";
    }
    if(is_admin()){
        $ShowClassBody = "show";
        $ShowClassButton = "";
    }

?>
<div class="AccordionItem">
    <?php if(is_admin()):?>
    <div class="row">
        <div class="col-12">
            <span class="badge bg-primary">
                Accordion Item
            </span>
        </div>
    </div>
    <?php endif; ?>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button <?php echo $ShowClassButton; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $AccordionID ; ?>" aria-expanded="true" aria-controls="collapseOne">
                <span class="d-flex justify-content-between align-items-center">
                    <?php echo $AccrdoionTitle; ?>
                    <i class="fa-solid fa-chevron-up"></i>
                </span>
            </button>
        </h2>
        <div id="<?php echo $AccordionID ; ?>" class="accordion-collapse collapse <?php echo $ShowClassBody; ?>" aria-labelledby="<?php echo $AccrdoionTitle; ?>" data-bs-parent="#<?php echo $ParentID; ?>">
            <div class="accordion-body">
                <InnerBlocks template="<?php echo esc_attr( wp_json_encode( $my_block_template ) ); ?>" />
            </div>
        </div>
    </div>
</div>