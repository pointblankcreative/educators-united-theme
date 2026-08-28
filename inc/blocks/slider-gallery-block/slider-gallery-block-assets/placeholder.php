<?php
    global $PlaceholderImageURL;
    global $PlaceholderImageAlt;

  $PlaceholderClasses = "";
  $PlaceholderDescription = $PlaceholderImageAlt;
  $PlaceholderMaxWidth = "width: 100%;";

  //placeholder images
  $PlaceholderImage1 = $PlaceholderImageURL;

  $PlaceholderImage2 = $PlaceholderImageURL;

  $PlaceholderImage3 = $PlaceholderImageURL;

  $PlaceholderImage4 = $PlaceholderImageURL;

  $PlaceholderImage5 = $PlaceholderImageURL;

  $PlaceholderImage6 = $PlaceholderImageURL;

  $PlaceholderImage7 = $PlaceholderImageURL;

  $PlaceholderImage8 = $PlaceholderImageURL;


?>
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
    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage1; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage2; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage3; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>
      
    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage4; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage5; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage6; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage7; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>

    <div class="<?php echo $PlaceholderClasses; ?>">
      <img class="img-fluid" style="<?php echo $PlaceholderMaxWidth; ?>" src="<?php echo $PlaceholderImage8; ?>" alt="<?php echo $PlaceholderDescription; ?>">
    </div>
    
  </div>
</div>