<div class="SliderWrapper <?php echo $classes; ?>">
  <ul class="control" id="<?php echo $SliderControlID; ?>">
    <li class="prev">
      <i class="fas fa-angle-left fa-2x"></i>
    </li>
    <li class="next">
      <i class="fas fa-angle-right fa-2x"></i>
    </li>
  </ul>
  <div class="<?php echo $SliderClass; ?>">
    <?php
      $SliderGalleryImageAlt = "";
      $SliderGalleryImageCaption = "";

      if($SliderGalleryImages == ""){
        global $PlaceholderImageURL;
        global $PlaceholderImageAlt;
        $SliderGalleryImageURL = $PlaceholderImageURL;
        $SliderGalleryImageAlt = $PlaceholderImageAlt;
      }
      else{
        $SliderGalleryImageURL = $SliderGalleryImages[0]["sizes"]['large'];
        $SliderGalleryImageAlt = esc_url($SliderGalleryImages[0]['alt']);

        if($SliderGalleryCaptionBool){
          $SliderGalleryImageCaption = $SliderGalleryImages[0]["caption"];
          if($SliderGalleryImageCaption == ""){
            $SliderGalleryImageCaption = "Placeholder Caption";
          }
        }
      }

    ?>
    <div class="d-flex flex-column align-items-center ">
      <img class="img-fluid" style="<?php echo $SliderGalleryMaxWidth; ?>" src="<?php echo $SliderGalleryImageURL; ?>" alt="<?php echo $SliderGalleryImageAlt; ?>">
      <?php if($SliderGalleryCaptionBool): ?>
      <div>
        <p style="color: <?php echo $SliderGalleryCaptionFontColour; ?>;">
          <?php echo $SliderGalleryImageCaption; ?>
        </p>
      </div>
      <?php endif; ?>
    </div>    
  </div>
</div>