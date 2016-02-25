<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('file/received/list',
    'can_read_files', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Files/Received/index.php';
$receivedFiles = Users\Files\Received\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map(function ($file) use ($mysqli) {
    return to_client_json($mysqli, $file);
}, $receivedFiles));
