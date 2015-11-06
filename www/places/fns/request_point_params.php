<?php

function request_point_params (&$errors, &$focus) {

    include_once __DIR__.'/../../fns/PlacePoints/request.php';
    list($latitude, $longitude, $altitude, $parsed_latitude,
        $parsed_longitude, $parsed_altitude) = PlacePoints\request();

    if ($latitude === '') {
        $errors[] = 'Enter latitude.';
        $focus = 'latitude';
    }

    if ($longitude === '') {
        $errors[] = 'Enter longitude.';
        if ($focus === null) $focus = 'longitude';
    }

    return [$latitude, $longitude, $altitude,
        $parsed_latitude, $parsed_longitude, $parsed_altitude];

}
