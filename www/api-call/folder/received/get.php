<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('folder/received/get',
    'can_read_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($receivedFolder));
