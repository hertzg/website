<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once '../fns/require_place.php';
$place = require_place($mysqli, $user);

include_once 'fns/require_point_params.php';
list($latitude, $longitude, $altitude) = require_point_params();

include_once '../../../fns/Users/Places/Points/add.php';
$id = Users\Places\Points\add($mysqli,
    $place, $latitude, $longitude, $altitude);

header('Content-Type: application/json');
echo $id;
