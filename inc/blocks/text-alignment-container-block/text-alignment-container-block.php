<?php

    //Field Preface
    $FieldPreface = "text_alignment_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //Default Variables
    $DesktopAlignmentClass = "";
    $TabletAlignmentClass = "";
    $MobileAlignmentClass = "";
    $TextAlignmentClasses = "";

    include get_template_directory() . '/inc/block-alignment-options/text_alignment_options.php';

    $allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/html', 'core/spacer', 'core/list' );
?>
<div class="TextAlignmentContainerBlock <?php echo $classes; ?>">
    <?php if(is_admin()):?>
    <div>
        <span class="badge bg-primary">
            Text Alignment Container Block
        </span>
    </div>
    <?php endif; ?>
    <div class="<?php echo $TextAlignmentClasses; ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" />
    </div>
</div>