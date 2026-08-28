<?php

function convert_phone_number_to_href($Number) {

    $Number = preg_replace('/[()\-\s]/', '', $Number);

    $Number = "tel:" . $Number;

    $Number = "href='" . $Number . "'";

    return $Number;
}