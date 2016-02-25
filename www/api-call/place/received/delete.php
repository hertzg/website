<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('place/received/delete',
    'can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/require_received_place.php';
$receivedPlace = require_received_place($mysqli, $user);

include_once '../../../fns/Users/Places/Received/delete.php';
Users\Places\Received\delete($mysqli, $receivedPlace, $apiKey);

header('Content-Type: application/json');
echo 'true';
