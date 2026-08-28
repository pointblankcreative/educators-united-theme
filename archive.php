<?php 

    $PageFieldPreface = "default_page_options-";

    wp_enqueue_style('archive_card');    

    //empty variables
    $ParentPostTypeName = "";
    $HasBanner = "";

    $PostType = get_queried_object();

    if (!property_exists($PostType, "taxonomy")){
        $PostType = get_queried_object();
        $PageTitle = $PostType->label; 
        if($PageTitle == ""){
            $PageTitle = "Posts";
        }
        $TaxinomySwitch = $PostType->name; 
    }
    else{
        //redirect home
        $HomeURL = get_home_url();
        wp_redirect( $HomeURL, 301 );

    }
    include_once('header.php');

    $BannerFieldPreface = "page_controls-";

?>

<main id="Main" class="NoHero"> 
    <div id="MainContent" class="MainContent">
        <div class="container">
            <h1 class="mb-1">
                <?php echo $PageTitle; ?>   
            </h1>
            <?php include get_template_directory() . '/inc/sections/archive/section-archive.php'; ?>
        </div>
    </div>
</main>

<?php include_once('footer.php'); ?>