<?php

function removeSpaces($inputString) {
    // Remove spaces
    $stringWithoutSpaces = str_replace(' ', '', $inputString);

    // Optionally, trim the string (remove leading and trailing spaces)
    $finalString = trim($stringWithoutSpaces);

    return $finalString;
}
add_action('wp_footer', 'removeSpaces');