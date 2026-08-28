<?php

function stripTagsAllowBreaks($inputString) {

    $allowedTags = '<br><br/>';
    $finalString = strip_tags($inputString, $allowedTags);

    return $finalString;
}
add_action('wp_footer', 'stripTagsAllowBreaks');