<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user);

include_once 'fns/request_place_params.php';
list($latitude, $longitude, $altitude, $name,
    $description, $tags, $tag_names) = request_place_params();

include_once '../../fns/Users/Places/edit.php';
Users\Places\edit($mysqli, $place, $latitude, $longitude, $altitude,
    $name, $description, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
