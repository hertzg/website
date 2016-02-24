<?php

include_once '../../fns/require_api_key.php';
require_api_key('place/point/add', 'can_write_places', $apiKey, $user, $mysqli);

include_once '../fns/require_place.php';
$place = require_place($mysqli, $user);

include_once 'fns/require_point_params.php';
require_point_params($latitude, $longitude, $altitude);

include_once '../../../fns/Users/Places/Points/add.php';
$id = Users\Places\Points\add($mysqli,
    $place, $latitude, $longitude, $altitude);

header('Content-Type: application/json');
echo $id;
