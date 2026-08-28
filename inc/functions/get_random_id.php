<?php

function get_random_id($length){    
    
    $RandomID = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),1,$length);

    return $RandomID;
}