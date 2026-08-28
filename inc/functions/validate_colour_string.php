<?php

function validateColourString($colourValue) {
    $HexPattern = "/^#[a-fA-F0-9]{6}$/";
    $RGBAPattern = "/^rgba?\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*(,\s*(0(\.\d+)?|1(\.0)?)\s*)?\)$/";
    if(preg_match($HexPattern, $colourValue)){
        $colourValue = $colourValue;
    }elseif(preg_match($RGBAPattern, $colourValue)){
        $colourValue = $colourValue;
    }else{
        $colourValue = "";
    }

    return $colourValue;
}
add_action('wp_footer', 'validateColourString');