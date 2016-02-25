<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('note/received/get',
    'can_read_notes', $apiKey, $user, $mysqli);

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($receivedNote));
