<?php

include_once '../fns/require_api_key.php';
require_api_key('folder/get', 'can_read_files', $apiKey, $user, $mysqli);

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($folder));
