<?php

namespace Latitude;

function request (&$latitude, &$parsed_latitude) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($latitude) = request_strings('latitude');

    include_once "$fnsDir/str_collapse_spaces.php";
    $latitude = str_collapse_spaces($latitude);

    include_once __DIR__.'/parse.php';
    $parsed_latitude = parse($latitude);

}
