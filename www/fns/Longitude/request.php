<?php

namespace Longitude;

function request (&$longitude, &$parsed_longitude) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($longitude) = request_strings('longitude');

    include_once "$fnsDir/str_collapse_spaces.php";
    $longitude = str_collapse_spaces($longitude);

    include_once __DIR__.'/parse.php';
    $parsed_longitude = parse($longitude);

}
