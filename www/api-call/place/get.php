<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('place/get', 'can_read_places', $apiKey, $user, $mysqli);

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($place));
