<?php

function request_place_params () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Places/request.php";
    list($latitude, $longitude, $altitude, $name,
        $description, $tags, $parsed_latitude, $parsed_longitude,
        $parsed_altitude) = Places\request();

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

    return [$parsed_latitude, $parsed_longitude,
        $parsed_altitude, $name, $description, $tags, $tag_names];

}
