<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user->id_users);

include_once '../../../fns/Users/Notes/Received/delete.php';
Users\Notes\Received\delete($mysqli, $receivedNote, $apiKey);

header('Content-Type: application/json');
echo 'true';
