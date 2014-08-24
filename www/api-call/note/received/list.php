<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_notes');

include_once '../../../fns/ReceivedNotes/indexOnReceiver.php';
$receivedNotes = ReceivedNotes\indexOnReceiver($mysqli, $user->id_users);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedNotes));
