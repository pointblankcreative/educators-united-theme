<?php

	//_banner_title
	$BannerTitle = get_field($PageFieldPreface . "_banner_title");

?>
<div class="BannerTextButtonContent">
	<div class="container">

		<div class="BannerTextButtonContentInner">
			<?php echo $BannerTitle; ?>

			<?php if( have_rows($PageFieldPreface . "_banner_buttons") ): ?>
				<div class="ThemeButtonGroup ThemeButtonWrapper">
					<?php while( have_rows($PageFieldPreface . "_banner_buttons") ) : the_row(); ?>
					<?php
						/*Empty Variables*/
						$ButtonHREF = "";
						$ButtonText = "";
						$ButtonTarget = "";
						$ButtonStyleSelection = "";
						$Download = "";

						$ButtonType = get_sub_field($PageFieldPreface . '_button_type');
						if($ButtonType == ""){
							$ButtonType = "link";
						}

						switch ($ButtonType) {
							case "download":

								$ButtonText = get_sub_field($PageFieldPreface . '_button_text');
								if($ButtonText == ""){
									$ButtonText = "Placeholder Text";
								}

								if(!is_admin()){
									$ButtonHREF = get_sub_field($PageFieldPreface . '_button_file');
									$ButtonHREF = "href='" . $ButtonHREF . "'";
									$Download = "download";
								}
						
								break;
								
							default:

								$LinkArray = get_sub_field($PageFieldPreface . '_button_link_text');

								$LinkArray = get_acf_link_elements($LinkArray);
								$ButtonText = $LinkArray['link-text'];
								$ButtonHREF = $LinkArray['link-href'];
								$ButtonTarget = $LinkArray['link-target'];
						
								break;
						
						}

						//Button Colour
						$ButtonStyleSelection = get_sub_field($PageFieldPreface . '_button_colour');
						if($ButtonStyleSelection == ""){
							$ButtonStyleSelection = "dark";
						}
					?>
						<a class="ThemeButton background <?php echo  $ButtonStyleSelection; ?>" <?php echo $ButtonHREF; ?> <?php echo $ButtonTarget; ?> <?php echo $Download; ?>>
							<?php echo $ButtonText; ?>
						</a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>