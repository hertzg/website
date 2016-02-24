<?php

include_once '../fns/require_api_key.php';
require_api_key('note/delete', 'can_write_notes', $apiKey, $user, $mysqli);

include_once 'fns/require_note.php';
$note = require_note($mysqli, $user);

include_once '../../fns/Users/Notes/delete.php';
Users\Notes\delete($mysqli, $note, $apiKey);

header('Content-Type: application/json');
echo 'true';
