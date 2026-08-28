<?php
  //Site Language
  $lang = get_bloginfo("language");

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php require get_template_directory() . '/inc/CSS/CustomCSS.php'; ?>