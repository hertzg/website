<?php

function request_place_params () {

    include_once __DIR__.'/../../../fns/Places/request.php';
    list($latitude, $longitude, $altitude, $name,
        $description, $parsed_latitude, $parsed_longitude,
        $parsed_altitude) = Places\request();

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$parsed_latitude, $parsed_longitude,
        $parsed_altitude, $name, $description, $tags, $tag_names];

}
