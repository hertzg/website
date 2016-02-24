<?php

include_once '../../fns/require_api_key.php';
require_api_key('note/received/delete',
    'can_write_notes', $apiKey, $user, $mysqli);

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user);

include_once '../../../fns/Users/Notes/Received/delete.php';
Users\Notes\Received\delete($mysqli, $receivedNote, $apiKey);

header('Content-Type: application/json');
echo 'true';
