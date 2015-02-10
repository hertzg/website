<?php

function request_place_params () {

    include_once __DIR__.'/../../../fns/Places/request.php';
    list($latitude, $longitude, $name,
        $parsed_latitude, $parsed_longitude) = Places\request();

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$parsed_latitude, $parsed_longitude, $name, $tags, $tag_names];

}
