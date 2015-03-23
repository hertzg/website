<?php

function request_longitude (&$longitude, &$parsed_longitude) {

    include_once __DIR__.'/request_strings.php';
    list($longitude) = request_strings('longitude');

    $longitude = preg_replace('/\s+/', '', $longitude);

    $parsed_longitude = (float)$longitude;
    $parsed_longitude = fmod($parsed_longitude + 180, 360) - 180;

}
