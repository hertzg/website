<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_note.php';
list($id, $note) = require_note($mysqli, $id_users);

include_once '../../fns/Users/Notes/delete.php';
Users\Notes\delete($mysqli, $id, $id_users);

header('Content-Type: application/json');
echo 'true';
