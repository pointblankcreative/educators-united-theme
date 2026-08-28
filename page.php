<?php 

    $PageFieldPreface = "default_page_options-";

    $FormType = "";
    $StickAlertBool = "";
    $HasBanner = "";

    include_once('header.php'); 


    $PageTitle = get_the_title();
    
    $PageFieldPreface = "default_page_options-";

    $AddBannerBool = get_field($PageFieldPreface . "_add_banner");

    if($AddBannerBool){
        $HasBanner = "HasBanner";
    }

    include_once('header.php'); 

    $StickAlertBool = get_field($PageFieldPreface . "_add_sticky_alert");
    if($StickAlertBool){
        wp_enqueue_script( 'sticky_alert');
    }
    
    
?>
<main id="Main"> 

    <?php
        if($AddBannerBool){
            include get_stylesheet_directory() . '/inc/sections/banner/section_banner.php';
        } 
    ?>

    <div class="MainContent">
        <div>
            <?php echo the_content(); ?>
        </div>
    </div>

    <?php if($StickAlertBool): ?>
        <div class="d-block d-md-none">
            <?php include get_stylesheet_directory() . '/inc/sections/page/sticky_alert/section-sticky_alert.php'; ?>
        </div>
    <?php endif; ?>

</main>

<?php include_once('footer.php');  ?>