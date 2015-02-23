<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once 'fns/require_point.php';
$point = require_point($mysqli, $user->id_users);

include_once 'fns/require_point_params.php';
list($latitude, $longitude, $altitude) = require_point_params();

include_once '../../../fns/Users/Places/Points/edit.php';
Users\Places\Points\edit($mysqli, $point, $latitude, $longitude, $altitude);

header('Content-Type: application/json');
echo 'true';
