<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $name = request_text('name');

    include_once "$fnsDir/request_strings.php";
    list($latitude, $longitude) = request_strings('latitude', 'longitude');

    $latitude = (float)$latitude;
    $longitude = (float)$longitude;

    return [$name];

}
