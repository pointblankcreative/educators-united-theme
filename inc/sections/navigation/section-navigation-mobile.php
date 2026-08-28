<div class="offcanvas offcanvas-end MobileNavigation" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="position-absolute top-0 end-0 CloseButton">
        <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-header d-flex justify-content-center">
        <a href="<?php echo $HomeURL; ?>" title="Home">
            <img class="img-fluid MobileLogo" src="<?php echo $MainLogoURL; ?>" alt="Site Logo">
        </a>
    </div>
    <div class="offcanvas-body">
        <?php require get_template_directory() . '/inc/navigations/navigation-mobile.php'; ?>
    </div>
</div>