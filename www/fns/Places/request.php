<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($latitude, $longitude, $altitude, $name) = request_strings(
        'latitude', 'longitude', 'altitude', 'name');

    $latitude = preg_replace('/\s+/', '', $latitude);
    $longitude = preg_replace('/\s+/', '', $longitude);
    $altitude = preg_replace('/\s+/', '', $altitude);

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    $parsed_latitude = (float)$latitude;
    $parsed_latitude = fmod($parsed_latitude + 180, 360) - 180;

    $parsed_longitude = (float)$longitude;
    $parsed_longitude = fmod($parsed_longitude + 180, 360) - 180;

    if ($altitude === '') $parsed_altitude = null;
    else $parsed_altitude = (float)$altitude;

    return [$latitude, $longitude, $altitude, $name,
        $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
