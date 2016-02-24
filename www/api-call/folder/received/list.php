<?php

include_once '../../fns/require_api_key.php';
require_api_key('folder/received/list',
    'can_read_files', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Folders/Received/index.php';
$receivedFolders = Users\Folders\Received\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedFolders));
