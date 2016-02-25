<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('note/received/import',
    'can_write_notes', $apiKey, $user, $mysqli);

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user);

include_once '../../../fns/Users/Notes/Received/import.php';
$id = Users\Notes\Received\import($mysqli,
    $receivedNote, false, null, $apiKey);

header('Content-Type: application/json');
echo $id;
