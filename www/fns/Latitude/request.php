<?php

namespace Latitude;

function request (&$latitude, &$parsed_latitude) {

    include_once __DIR__.'/../request_strings.php';
    list($latitude) = request_strings('latitude');

    $latitude = preg_replace('/\s+/', '', $latitude);

    include_once __DIR__.'/parse.php';
    $parsed_latitude = parse($latitude);

}
