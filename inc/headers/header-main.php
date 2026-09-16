<?php
  //Site Language
  $lang = get_bloginfo("language");

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NSVDRMZ2');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon: campaign sparkle mark (used by the 3 custom promo/privacy
         templates that include this header partial; the rest of the site's
         default header.php is untouched). -->
    <link rel="icon" type="image/png" sizes="17x17" href="<?php echo esc_url( get_template_directory_uri() . '/images/promo/FaviconSmall.png' ); ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url( get_template_directory_uri() . '/images/promo/FaviconLarge.png' ); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/images/promo/FaviconLarge.png' ); ?>">
    <?php
        // Social preview (Open Graph / Twitter Card) tags. The calling
        // template sets $GLOBALS['EU_Social*'] before including this header
        // partial — using $GLOBALS rather than plain local variables because
        // get_template_part()/load_template() runs this file in its own
        // function scope, so ordinary variables set in the calling template
        // wouldn't otherwise be visible here. EN values are the fallback for
        // any page that doesn't set its own (e.g. Privacy Policy).
        $EU_SocialTitle       = $GLOBALS['EU_SocialTitle'] ?? 'Not A Game';
        $EU_SocialDescription = $GLOBALS['EU_SocialDescription'] ?? "Education is not a game. It's time the Ontario Government stopped treating it like one.";
        $EU_SocialImageURL    = $GLOBALS['EU_SocialImageURL'] ?? ( get_template_directory_uri() . '/images/promo/ScrapeEN.png' );
        $EU_SocialLocale      = $GLOBALS['EU_SocialLocale'] ?? 'en_CA';
        $EU_SocialURL         = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo esc_attr( $EU_SocialTitle ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $EU_SocialTitle ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $EU_SocialDescription ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $EU_SocialImageURL ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $EU_SocialURL ); ?>">
    <meta property="og:locale" content="<?php echo esc_attr( $EU_SocialLocale ); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $EU_SocialTitle ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $EU_SocialDescription ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $EU_SocialImageURL ); ?>">
    <?php wp_head(); ?>