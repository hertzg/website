<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_latitude.php";
    request_latitude($latitude, $parsed_latitude);

    include_once "$fnsDir/request_longitude.php";
    request_longitude($longitude, $parsed_longitude);

    include_once "$fnsDir/request_altitude.php";
    request_altitude($altitude, $parsed_altitude);

    include_once "$fnsDir/request_strings.php";
    list($name) = request_strings('name');

    include_once "$fnsDir/request_text.php";
    $description = request_text('description');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    return [$latitude, $longitude, $altitude, $name, $description,
        $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
