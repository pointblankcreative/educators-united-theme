<?php
    include get_stylesheet_directory() . '/inc/sections/banner/banner_colour_fields.php';

    $banner_class = 'SectionBanner';
    if ( ! empty( $BannerStyle ) ) {
        $banner_style_attr = ' style="' . esc_attr( $BannerStyle ) . '"';
    } else {
        $banner_style_attr = '';
    }

?>
<div class="SectionBanner" <?php echo $banner_style_attr; ?> role="img" <?php echo ( $BannerImageAlt !== '' ) ? ' aria-label="' . esc_attr( $BannerImageAlt ) . '"' : ''; ?>>
    <?php include get_stylesheet_directory() . '/inc/sections/banner/banner_titles_and_buttons.php'; ?>
</div>