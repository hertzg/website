<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_files');

include_once '../../../fns/ReceivedFiles/Committed/indexOnReceiver.php';
$receivedFiles = ReceivedFiles\Committed\indexOnReceiver(
    $mysqli, $user->id_users);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedFiles));
