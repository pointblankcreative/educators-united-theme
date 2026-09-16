<?php
/**
 * Google Tag Manager <noscript> fallback, output immediately after the
 * opening <body> tag via the wp_body_open hook — every template in this
 * theme already calls wp_body_open() right after <body> (see header.php and
 * the 3 custom promo/privacy templates), so this covers the whole site
 * without needing to edit each template individually.
 *
 * The GTM <script> snippet itself lives in inc/headers/header-main.php.
 */
function eu_google_tag_manager_noscript() {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NSVDRMZ2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action( 'wp_body_open', 'eu_google_tag_manager_noscript' );
