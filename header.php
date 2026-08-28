<?php 

    include get_stylesheet_directory() . '/inc/sections/scripts/section-header-footer-scripts.php';

    get_template_part('inc/headers/header' , 'main'); 

    $GetTheLogo = get_theme_mod( 'custom_logo' );

    if($GetTheLogo == ""){
        global $PlaceholderImageURL;
        $MainLogoURL = $PlaceholderImageURL;
    }
    else{
        $MainLogo = wp_get_attachment_image_src( $GetTheLogo , 'large' );
        $MainLogoURL = $MainLogo[0];

    }
    $HomeURL = get_home_url();

    
    $RemoveNavBar = get_field($PageFieldPreface . "_remove_nav_bar");
    if(!$RemoveNavBar){
        $OverRideLogo = get_field($PageFieldPreface . "_override_main_logo");
        if($OverRideLogo != ""){
            $OverRideLogo = get_image_and_alt($OverRideLogo);
            $MainLogoURL = $OverRideLogo['src'];
        }
    }  
    
?>
</head>
<body id="BodyID" class="preload">
<?php wp_body_open(); ?>

<?php 
    if(!$RemoveNavBar){
        include get_stylesheet_directory() . '/inc/sections/navigation/section-navigation.php';
    }
?>