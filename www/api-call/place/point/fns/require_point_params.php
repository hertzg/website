<?php

function require_point_params (&$parsed_latitude,
    &$parsed_longitude, &$parsed_altitude) {

    include_once __DIR__.'/../../../../fns/PlacePoints/request.php';
    list($latitude, $longitude, $altitude, $parsed_latitude,
        $parsed_longitude, $parsed_altitude) = PlacePoints\request();

}
