<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($latitude, $longitude, $name) = request_strings(
        'latitude', 'longitude', 'name');

    $latitude = (float)$latitude;
    $longitude = (float)$longitude;

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    return [$latitude, $longitude, $name];

}
