<?php

function removeSpacesAndSpecialChars($inputString) {
    // Remove spaces
    $stringWithoutSpaces = str_replace(' ', '', $inputString);

    // Remove special characters using regex
    $stringWithoutSpecialChars = preg_replace('/[^A-Za-z0-9]/', '', $stringWithoutSpaces);

    // Optionally, trim the string (remove leading and trailing spaces)
    $finalString = trim($stringWithoutSpecialChars);

    return $finalString;
}
add_action('wp_footer', 'removeSpacesAndSpecialChars');