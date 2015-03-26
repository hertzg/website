<?php

namespace Longitude;

function request (&$longitude, &$parsed_longitude) {

    include_once __DIR__.'/../request_strings.php';
    list($longitude) = request_strings('longitude');

    $longitude = preg_replace('/\s+/', '', $longitude);

    include_once __DIR__.'/parse.php';
    $parsed_longitude = parse($longitude);

}
