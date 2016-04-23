<?php

function get_client_address () {

    include_once __DIR__.'/NumReverseProxies/get.php';
    $numReverseProxies = \NumReverseProxies\get();

    if ($numReverseProxies === 0) return $_SERVER['REMOTE_ADDR'];
    if (!array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) return false;

    $parts = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
    while ($numReverseProxies > 0) {
        if (!$parts) return false;
        $address = array_pop($parts);
        $numReverseProxies--;
    }
    return $address;

}
