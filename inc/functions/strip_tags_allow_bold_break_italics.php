<?php

function stripTagsAllowBoldBreakItalics($inputString) {

    $allowedTags = '<b></b><i></i><br><br/><em></em><strong></strong>';
    $finalString = strip_tags($inputString, $allowedTags);

    return $finalString;
}
add_action('wp_footer', 'stripTagsAllowBoldBreakItalics');