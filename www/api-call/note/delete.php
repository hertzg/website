<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_note.php';
list($id, $note) = require_note($mysqli, $id_users);

include_once '../../fns/Notes/delete.php';
Notes\delete($mysqli, $id);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/Users/Notes/addNumber.php';
Users\Notes\addNumber($mysqli, $id_users, -1);

header('Content-Type: application/json');
echo 'true';
