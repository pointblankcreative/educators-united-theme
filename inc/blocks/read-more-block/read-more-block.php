<?php

    wp_enqueue_style("read_more_block");

    //Field Preface
    $FieldPreface = "read_more_block-";

    //empty variables
    $DisplayClass = "active";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = "ReadMoreBlock";
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    if(!is_admin()){
        $DisplayClass = "";
    }

    $RandomID = get_random_id(4);

    //translation
    $ReadMoreText = get_field($FieldPreface . "_title");
    $ReadMoreText = strip_tags($ReadMoreText);
    if($ReadMoreText == ""){
        $ReadMoreText = "Read More";
    }
    $ReadLessText = $ReadMoreText;

    $ReadMoreTextColor = get_field($FieldPreface . "_title_color");
    $ReadMoreTextColor = "style='color:" . $ReadMoreTextColor . " !important;'";

?>
<div class="<?php echo $classes; ?>">
    <?php if(is_admin()):?>
        <span class="badge bg-primary">
            Read More Block
        </span>
    <?php endif; ?>
    <div class="mb-1">
    <?php if(!is_admin()):?>
        <p class="mb-0">
            <a id="ReadMore<?php echo $RandomID; ?>" class="Pointer read-more-link fw-bold" <?php echo $ReadMoreTextColor; ?>>
                <?php echo $ReadMoreText; ?>
            </a>
        </p>
    <?php else: ?>
        <p id="ReadMore<?php echo $RandomID; ?>" class="Pointer read-more-link fw-bold" <?php echo $ReadMoreTextColor; ?>>
            <?php echo $ReadMoreText; ?>
        </p>
    <?php endif; ?>
    </div>
    <div id="ReadMoreSection<?php echo $RandomID; ?>" class="read-more <?php echo $DisplayClass; ?>">
        <div class="py-2">
            <InnerBlocks  />
        </div>
    </div>
</div>
<?php if(!is_admin()):?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ReadMore<?php echo $RandomID; ?> = document.getElementById('ReadMore<?php echo $RandomID; ?>');

    ReadMore<?php echo $RandomID; ?>.addEventListener('click', ReadMore<?php echo $RandomID; ?>Function, false);
});
function ReadMore<?php echo $RandomID; ?>Function(){
    var ReadMoreSection = document.getElementById('ReadMoreSection<?php echo $RandomID; ?>');
    var ReadMoreLink = document.getElementById('ReadMore<?php echo $RandomID; ?>');
    

    if (!ReadMoreSection.classList.contains('active')) {
        ReadMoreSection.classList.add('active');
        ReadMoreSection.style.height = "auto";

        var height = ReadMoreSection.clientHeight + "px";

        ReadMoreSection.style.height = "0px";

        setTimeout(() => {
            ReadMoreSection.style.height = height
        }, 0);

        ReadMoreLink.innerHTML = "<?php echo $ReadLessText; ?>";
        ReadMoreLink.classList.add('active');

        
    }
    else{

        ReadMoreSection.style.height = "0px"
        ReadMoreSection.addEventListener('transitionend', () => {
        	ReadMoreSection.classList.remove('active')
        }, {once: true})
        ReadMoreLink.innerHTML = "<?php echo $ReadMoreText; ?>";
        ReadMoreLink.classList.remove('active');

    }
}
</script>
<?php endif; ?>