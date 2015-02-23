<?php

function require_point_params () {

    include_once __DIR__.'/../../../../fns/PlacePoints/request.php';
    list($latitude, $longitude, $altitude, $parsed_latitude,
        $parsed_longitude, $parsed_altitude) = PlacePoints\request();

    return [$parsed_latitude, $parsed_longitude, $parsed_altitude];

}
