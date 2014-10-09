<?php

function get_client_address () {
//    $xForwardedFor = $_SERVER['HTTP_X_FORWARDED_FOR'];
//    $xForwardedFor = explode(', ', $xForwardedFor);
//    $xForwardedFor = array_pop($xForwardedFor);
//    return $xForwardedFor;
    return $_SERVER['REMOTE_ADDR'];
}
