<?php

  wp_enqueue_style( 'splide');
  wp_enqueue_style( 'slider_gallery');
  wp_enqueue_script( 'splide' );

  if($SliderGalleryGlightboxBool){
    wp_enqueue_style( 'glightbox');
    wp_enqueue_script( 'glightbox' );
    wp_enqueue_script( 'glightbox_config' );
  }
  
?>
<div id="<?php echo $SliderClass ; ?>" class="splide SliderGallery <?php echo $SliderClass ; ?>">
    <div class="splide__track">
		<div class="splide__list">
        <?php foreach( $SliderGalleryImages as $SliderGalleryImage ): ?>
            <?php
                $SliderGalleryCaptionGlightbox = "";
                $SliderGalleryImageURL = $SliderGalleryImage["sizes"]['large'];
                $SliderGalleryImageAlt = esc_url($SliderGalleryImage['alt']);

                if($SliderGalleryCaptionBool){
                  $SliderGalleryImageCaption = $SliderGalleryImage["caption"];
                  $SliderGalleryCaptionGlightbox = 'data-glightbox="description:'. $SliderGalleryImageCaption  .'"';
                }
                
            ?>
            <div class="splide__slide <?php echo $SliderFlexClasses; ?>">
              <div>
              <?php if ( $SliderGalleryGlightboxBool ) : ?>
                <a class="glightbox" data-gallery="<?php echo $SliderGalleryGlightboxClass; ?>"  href="<?php echo $SliderGalleryImageURL; ?>" <?php echo $SliderGalleryCaptionGlightbox; ?>>
              <?php endif; ?>
                <img class="img-fluid" style="<?php echo $SliderGalleryMaxWidth; ?> !important;" src="<?php echo $SliderGalleryImageURL; ?>" alt="<?php echo $SliderGalleryImageAlt; ?>" />
              <?php if ( $SliderGalleryGlightboxBool ) : ?>
                </a>
              <?php endif; ?>
              <?php if($SliderGalleryCaptionBool): ?>
                <p class="text-center" style="color: <?php echo $SliderGalleryCaptionFontColour; ?>;">
                  <?php echo $SliderGalleryImageCaption; ?>
                </p>
              <?php endif; ?>
              </div>
              
            </div>
        <?php endforeach;?>
        </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var sliderInstance = new Splide('.<?php echo $SliderClass; ?>', {
    rewind: true,
    pagination: false,
    <?php if ($SliderGalleryAutoplayBool): ?>
    autoplay: true,
    interval: <?php echo $SliderGalleryAutoplaySpeed; ?>,
    <?php endif; ?>
    <?php if ($SliderGalleryAnimation == "Fade"): ?>
    type: 'fade',
    <?php endif; ?>
  });

  sliderInstance.on('mounted moved', function () {
    var activeSlide = sliderInstance.Components.Elements.slides[sliderInstance.index];
    var img = activeSlide ? activeSlide.querySelector('img') : null;
    var imgHeight = img.clientHeight;
    <?php if($SliderGalleryCaptionBool): ?>
    imgHeight = imgHeight + 30;
    <?php endif; ?>
    var sliderElement = document.getElementById("<?php echo $SliderClass; ?>");

    if (img && sliderElement) {
      var newHeight = Math.min(imgHeight, 500) + 'px';
      activeSlide.style.height = newHeight;
      sliderElement.style.height = newHeight;
    }
  });

  sliderInstance.mount();
});
</script>
