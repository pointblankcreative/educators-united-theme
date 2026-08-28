<?php 

    wp_enqueue_style("popup");

    //Field Preface
    $FieldPreface = "popup_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    $ModalID = get_field($FieldPreface . '_id');
    $ModalID = strip_tags($ModalID);
    $ModalID = removeSpacesAndSpecialChars($ModalID);
    $ModalSize = get_field($FieldPreface . '_popup_size');

    $PopupTitle = get_field($FieldPreface . "_popup_title");

    if($PopupTitle != ""){
        $TitleFlex = "justify-content-between";
    }else{
        $TitleFlex = "justify-content-end";
    }

    $allowed_blocks = array( 'core/columns', 'core/spacer', 'core/seperator', 'core/image', 'core/heading', 'core/paragraph', 'acf/theme-button-block', 'acf/share-buttons-block', 'acf/fancy-divider-line-block', 'acf/social-media-buttons-block', 'acf/theme-image-block', 'contact-form-7/contact-form-selector' );
?>
<?php if (!is_admin()): ?>
<div class="modal fade <?php echo $classes; ?>" id="<?php echo $ModalID; ?>" tabindex="-1" aria-labelledby="<?php echo $ModalID; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered <?php echo $ModalSize; ?>">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex <?php echo $TitleFlex; ?>">
                    <?php if($PopupTitle != ""): ?>
                    <?php
                        $PopupTitle = strip_tags($PopupTitle);    
                    ?>
                    <div>
                        <h4>
                            <?php echo $PopupTitle; ?>
                        </h4>
                    </div>
                    <?php endif; ?>
                    <div>
                        <button type="button" class="ButtonClose" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>  
                    </div>
                </div>  
                <?php if($PopupTitle != ""): ?> 
                <hr/>
                <?php endif; ?>
                <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="InfoCardBlock <?php echo $classes; ?>">
    <div class="d-flex justify-content-between">
        <div>
            <h4>
                <?php echo $PopupTitle; ?>
            </h4>
        </div>
        <div>
            <button type="button" class="ButtonClose" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>  
        </div>
    </div>   
    <hr/>
    <div>
        <p> 
            <span class='badge bg-primary'>
                Popup Block
            </span> 
        </p>
        <p>
            <strong>
                NOTE:
            </strong>
            This block is hidden on website, but can be activated through a Popup Button Block.
        </p>
    </div>
    <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
</div>
<?php endif; ?>