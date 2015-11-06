<?php

function request_place_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Places/request.php";
    list($latitude, $longitude, $altitude, $name,
        $description, $tags, $parsed_latitude, $parsed_longitude,
        $parsed_altitude) = Places\request();

    if ($latitude === '') {
        $errors[] = 'Enter latitude.';
        $focus = 'latitude';
    }

    if ($longitude === '') {
        $errors[] = 'Enter longitude.';
        if ($focus === null) $focus = 'longitude';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$latitude, $longitude, $altitude, $name, $description, $tags,
        $tag_names, $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
