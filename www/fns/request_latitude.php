<?php

function request_latitude (&$latitude, &$parsed_latitude) {

    include_once __DIR__.'/request_strings.php';
    list($latitude) = request_strings('latitude');

    $latitude = preg_replace('/\s+/', '', $latitude);

    $parsed_latitude = max(-90, min(90, (float)$latitude));

}
