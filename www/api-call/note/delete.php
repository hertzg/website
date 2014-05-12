<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_note.php';
$note = require_note($mysqli, $user->id_users);

include_once '../../fns/Users/Notes/delete.php';
Users\Notes\delete($mysqli, $note);

header('Content-Type: application/json');
echo 'true';
