<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($latitude, $longitude, $name) = request_strings(
        'latitude', 'longitude', 'name');

    $latitude = preg_replace('/\s+/', '', $latitude);
    $longitude = preg_replace('/\s+/', '', $longitude);

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    $parsed_latitude = (float)$latitude;
    $parsed_longitude = (float)$longitude;

    $parsed_latitude = ($parsed_latitude + 180) % 360 - 180;
    $parsed_longitude = ($parsed_longitude + 180) % 360 - 180;

    return [$latitude, $longitude, $name, $parsed_latitude, $parsed_longitude];

}
