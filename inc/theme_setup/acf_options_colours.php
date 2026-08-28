<?php
/*
    this hooks into ACFs options pages and adds a js file that will display the theme colors (which has to be programmed into the js file)
*/
new add_boxes_to_options_page();
  
class add_boxes_to_options_page {
  
    public function __construct() {
        add_action("acf/input/admin_head", array($this, "add_boxes_before"), 1);
    }
  
    public function add_boxes_before() {

        function enqueue_options_page_color_picker() {
            include get_stylesheet_directory() . '/inc/scripts/colour_picker.php';
        }
        $screen = get_current_screen();
        //echo "<div style='text-align: center;'><h1>" . $screen->id . "</h1></div>";

        switch ($screen->id) {
            case "misc-site-settings_page_acf-options-footer-controls":
                enqueue_options_page_color_picker();
                break;
        }
        
    }  
}