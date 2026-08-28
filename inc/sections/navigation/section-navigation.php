<?php
    $MenuBool = false;
    $MenuSelection = 'primary-menu';

    $locations = get_nav_menu_locations();
    
    if($locations){
        $menu_id   = $locations[ $MenuSelection ] ;
        $menu = wp_get_nav_menu_object( $menu_id );
        if($menu){
            if($menu->count > 0){
                $MenuBool = true;
            }
        }
    }

    $LanguageTogglerBool = get_field("add_language_toggler", "options");


    $DisableLogoBool = get_field($PageFieldPreface . "_hide_navigation_logo");
    if($DisableLogoBool == true){
        $LogoVisibilityClass = "d-none";
    }else{
        $LogoVisibilityClass = "d-block";
    }
    

?>

    <?php if($MenuBool): ?>
    <div class="d-block d-lg-none">
        <?php require get_template_directory() . '/inc/sections/navigation/section-navigation-mobile.php'; ?>
    </div>
    <?php endif; ?>
    <div id="MainNavigation" class="MainNavigation <?php echo $HasBanner; ?>">
        <div class="container">        
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a class="<?php echo $LogoVisibilityClass; ?>" href="<?php echo $HomeURL; ?>" title="Home">
                        <img class="img-fluid MainLogo" src="<?php echo $MainLogoURL; ?>" alt="Site Logo">
                    </a>
                </div>
                
                <div class="MainNavItems">
                    <?php if($MenuBool): ?>
                        <div class="d-none d-lg-block">
                            <?php require get_template_directory() . '/inc/navigations/navigation-desktop.php'; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($LanguageTogglerBool): ?>
                        <?php echo language_desktop_toggler(); ?>
                    <?php endif; ?>
                </div>
                <?php if($MenuBool): ?>
                <div class="d-block d-lg-none">
                    <div class="BurgerMenu">
                        <button class="p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div> 
            <?php endif; ?>
            </div>
        </div>
    </div>