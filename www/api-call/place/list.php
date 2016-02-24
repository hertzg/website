<?php

include_once '../fns/require_api_key.php';
require_api_key('place/list', 'can_read_places', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Places/index.php';
$places = Users\Places\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $places));
