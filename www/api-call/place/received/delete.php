<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once 'fns/require_received_place.php';
$receivedPlace = require_received_place($mysqli, $user->id_users);

include_once '../../../fns/Users/Places/Received/delete.php';
Users\Places\Received\delete($mysqli, $receivedPlace, $apiKey);

header('Content-Type: application/json');
echo 'true';
