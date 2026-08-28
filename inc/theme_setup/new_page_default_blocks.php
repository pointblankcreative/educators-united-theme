<?php

function myplugin_register_template() {


    $post_type_object1 = get_post_type_object( 'page' );
    $post_type_object1->template = array(
        array( 'acf/container-block', array(), array(
            array( 'core/paragraph', array(
                'placeholder' => 'Add some content here!',
            ) ),
        ) ),
    );
    
}
add_action( 'init', 'myplugin_register_template' );