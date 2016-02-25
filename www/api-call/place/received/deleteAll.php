<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('place/received/deleteAll',
    'can_write_places', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Places/Received/deleteAll.php';
Users\Places\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
