<nav class="navbar navbar-expand-md d-none d-md-flex">
        <?php 
            wp_nav_menu(array(
                'theme_location' => 'primary-menu', 
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'MainNavItems',
                'container'       => false,
                'depth'           => 2,
                'walker'          => new WPDocs_Walker_Nav_Menu(),
            ));
        ?>
</nav>

<?php
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">';
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Apply WordPress filter for additional classes
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        
        $has_children = in_array('menu-item-has-children', $classes);
        $dropdown_class = $has_children ? 'dropdown' : '';
    
        // Add filtered classes and dropdown class
        $output .= '<li class="nav-item ' . esc_attr($dropdown_class . ' ' . $class_names) . '">';
    
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) .'"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) .'"' : '';
    
        $link_class = $depth === 0 ? 'nav-link' : 'dropdown-item';
        if ($has_children) {
            $link_class .= ' dropdown-toggle';
            $attributes .= ' data-bs-toggle="dropdown" aria-expanded="false"';
        }
    
        $item_output = sprintf('<a class="%s" %s>%s%s%s</a>',
            esc_attr($link_class),
            $attributes,
            $args->link_before,
            apply_filters('the_title', $item->title, $item->ID),
            $args->link_after
        );
    
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
}

?>
