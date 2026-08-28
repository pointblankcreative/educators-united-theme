<?php

  // Create class attribute allowing for custom "className" and "align" values.
  $classes = '';
  if( !empty($block['className']) && !is_admin() ) {
      $classes .= sprintf( ' %s', $block['className'] );
  }
    
  //Empty Variables
  $SliderGalleryAutoplaySpeed = "";
  $SliderGalleryCaptionFontColour = "";
  $SliderGalleryGlightboxClass = "";
  $SliderFlexClasses = "";

  $length = 10;    
  $SliderClass = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
  $SliderControlID = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);


  //Slider Animation
  $SliderGalleryAnimation = get_field('slider_animation');

  //Gallery Images
  $SliderGalleryImages = get_field('gallery_images');

  //Max Image Width
  $SliderGalleryMaxWidth = "width: 100%;";//default size

  $ChangeSliderGalleryImageSizeBool = get_field('change_slider_gallery_width');
  if($ChangeSliderGalleryImageSizeBool){
    $SliderGalleryMaxWidth = "width: " . get_field('slider_gallery_max_width') . "px";
    $SliderFlexClasses = "d-flex justify-content-center";
  }

  //Autoplay

  $SliderGalleryAutoplayBool = get_field('gallery_autoplay');
  if($SliderGalleryAutoplayBool){
    $SliderGalleryAutoplaySpeed = get_field('autoplay_speed');
  }

  //Caption Bool
  $SliderGalleryCaptionBool = get_field('caption_gallery');
  if($SliderGalleryCaptionBool){
    $SliderGalleryCaptionFontColour = get_field('gallery_caption_font_colour');
  }

  //Lightbox
  $SliderGalleryGlightboxBool = get_field('gallery_lightbox');
  if($SliderGalleryGlightboxBool){
    $SliderGalleryGlightboxClass = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
  }

?>
<?php if(!is_admin()): ?>
  <?php if($SliderGalleryImages):?>
    <?php require get_template_directory() . '/inc/blocks/slider-gallery-block/slider-gallery-block-assets/frontend.php'; ?>
  <?php else: ?>
    <?php require get_template_directory() . '/inc/blocks/slider-gallery-block/slider-gallery-block-assets/placeholder.php'; ?>
  <?php endif; ?>
<?php else: ?>
  <?php require get_template_directory() . '/inc/blocks/slider-gallery-block/slider-gallery-block-assets/backend.php'; ?>
<?php endif; ?>