<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/require_point.php';
$point = require_point($mysqli, $user->id_users);

include_once '../../../fns/Places/get.php';
$place = Places\get($mysqli, $point->id_places);

if ($place->num_points < 2) {
    include_once '../../../fns/ApiCall/Error/badRequest.php';
    ApiCall\Error\badRequest('"LAST_POINT"');
}

include_once '../../../fns/Users/Places/Points/delete.php';
Users\Places\Points\delete($mysqli, $point);

header('Content-Type: application/json');
echo 'true';
