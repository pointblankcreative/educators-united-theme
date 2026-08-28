<?php 

    $PageFieldPreface = "default_page_options-";

    $HasBanner = "";

    wp_enqueue_style('share_buttons');

    include_once("header.php");

    $PageTitle = get_the_title();

    $BannerFieldPreface = "page_controls-";

?>

<main id="Main" class="NoHero"> 

    <div id="MainContent" class="MainContent">
        <div class="container">
            <h1>
                <?php the_title(); ?>
            </h1>
            <?php echo the_content(); ?>
            <?php include get_stylesheet_directory() . "/inc/sections/single/section-share-buttons.php"; ?>
            <?php include get_stylesheet_directory() . "/inc/sections/single/section-previous-next-post-nav.php"; ?>
        </div>
    </div>

</main>

<?php include_once('footer.php'); ?>