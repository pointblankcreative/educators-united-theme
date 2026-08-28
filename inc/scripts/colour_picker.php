<?php
global $theme_editor_colours;
$colour_picker_palettes = array_values( $theme_editor_colours );
?>
<script>
(function($){
    acf.add_filter('color_picker_args', function( args, $field ){
        args.palettes = <?php echo wp_json_encode( $colour_picker_palettes ); ?>;
        return args;
    });
})(jQuery);
</script>