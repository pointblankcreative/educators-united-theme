<?php 

    $PageFieldPreface = "404_redirect_page-";

    $HasBanner = "";

    $RedirectBool = get_field($PageFieldPreface . "_set_a_redirect_for_404_pages", "options");

    if($RedirectBool){
        $PageRedirectLink = get_field($PageFieldPreface . "_page_select", "options");
        header("Location: " .$PageRedirectLink );
        exit;
    }

    $HasBanner = "";

    include_once('header.php');

    $PageTitle = "404 Error";

?>

<main id="Main" class="NoBannerClass"> 

    <div>
        <div class="container">
            <div class="ErrorContent">
                <h1 class="mb-4"><?php echo $PageTitle; ?></h1>
                <?php dynamic_sidebar('error-page-content'); ?>
            </div>
        </div>
    </div>

</main>

<?php include_once('footer.php');  ?>