<?php

namespace PlacePoints;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Latitude/request.php";
    \Latitude\request($latitude, $parsed_latitude);

    include_once "$fnsDir/request_longitude.php";
    request_longitude($longitude, $parsed_longitude);

    include_once "$fnsDir/request_altitude.php";
    request_altitude($altitude, $parsed_altitude);

    return [$latitude, $longitude, $altitude,
        $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
