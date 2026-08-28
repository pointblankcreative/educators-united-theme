<?php 

function get_acf_link_elements($LinkArray){

    $LinkHREF = "";
    $LinkTarget = "";
    $LinkText = "";

    if($LinkArray != ""){
        /*Theme Text*/
        $LinkText = esc_html($LinkArray['title']);
        if(empty($LinkText)){
            $LinkText = 'Placeholder text';
        }

        /*Theme Link*/
        if(!is_admin()){
            $Link = esc_url($LinkArray['url']);
            $LinkHREF = 'href="'. $Link .'"';

            $LinkTarget = esc_attr($LinkArray['target'] ? $LinkArray['target'] : '_self');
            $LinkTarget = "target='". $LinkTarget ."'";
        }
    }else{
        $LinkText = 'Placeholder text';
    }
    $LinkText = strip_tags($LinkText);

    return [
        'link-text' => $LinkText,
        'link-href' => $LinkHREF,
        'link-target' => $LinkTarget
    ];
}