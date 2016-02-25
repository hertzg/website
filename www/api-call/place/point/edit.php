<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('place/point/edit',
    'can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/require_point.php';
$point = require_point($mysqli, $user->id_users);

include_once 'fns/require_point_params.php';
require_point_params($latitude, $longitude, $altitude);

include_once '../../../fns/Users/Places/Points/edit.php';
Users\Places\Points\edit($mysqli, $point,
    $latitude, $longitude, $altitude, $changes);

header('Content-Type: application/json');
echo 'true';
