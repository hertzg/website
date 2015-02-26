<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once 'fns/require_note.php';
$note = require_note($mysqli, $user);

include_once '../../fns/Users/Notes/delete.php';
Users\Notes\delete($mysqli, $note, $apiKey);

header('Content-Type: application/json');
echo 'true';
