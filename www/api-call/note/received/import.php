<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user->id_users);

include_once '../../../fns/Users/Notes/Received/import.php';
$id = Users\Notes\Received\import($mysqli, $receivedNote);

header('Content-Type: application/json');
echo $id;
