<?php

namespace Places;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Latitude/request.php";
    \Latitude\request($latitude, $parsed_latitude);

    include_once "$fnsDir/Longitude/request.php";
    \Longitude\request($longitude, $parsed_longitude);

    include_once "$fnsDir/request_altitude.php";
    request_altitude($altitude, $parsed_altitude);

    include_once "$fnsDir/request_strings.php";
    list($name, $tags) = request_strings('name', 'tags');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/request_text.php";
    $description = request_text('description');
    $description = mb_substr($description, 0,
        $maxLengths['description'], 'UTF-8');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);
    $name = mb_substr($name, 0, $maxLengths['name'], 'UTF-8');

    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    return [$latitude, $longitude, $altitude, $name, $description,
        $tags, $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
