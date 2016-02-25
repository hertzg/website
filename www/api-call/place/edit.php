<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('place/edit', 'can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user);

include_once 'fns/require_place_params.php';
require_place_params($latitude, $longitude,
    $altitude, $name, $description, $tags, $tag_names);

include_once '../../fns/Users/Places/edit.php';
Users\Places\edit($mysqli, $place, $latitude, $longitude, $altitude,
    $name, $description, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
