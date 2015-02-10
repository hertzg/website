<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user->id_users);

include_once '../../fns/Users/Places/delete.php';
Users\Places\delete($mysqli, $place, $apiKey);

header('Content-Type: application/json');
echo 'true';
