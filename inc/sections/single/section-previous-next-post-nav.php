<?php

    $NextPostColumns = "col-md-6 col-12";
    if(get_previous_post_link('%link', 'Previous', false) == "" && get_next_post_link('%link', 'Next Post', false) != ""){
        $NextPostColumns = "col-12";
    }
?>
<div>
    <hr>
</div>
<div class="row PostNavigation">
    <?php if(get_previous_post_link('%link', 'Previous', false) != ""): ?>
    <div class="col-md-6 col-12 PreviousPost">
        <i class="fas fa-caret-left"></i>
        <?php echo get_previous_post_link('%link', 'Previous', false); ?>
    </div>
    <?php endif; ?>
    <?php if(get_next_post_link('%link', 'Next', false) != ""): ?>
    <div class="<?php echo $NextPostColumns; ?> text-end NextPost">
        <?php echo get_next_post_link('%link', 'Next', false); ?>
        <i class="fas fa-caret-right"></i>
    </div>
    <?php endif; ?>
</div>
<div>
    <hr>
</div>