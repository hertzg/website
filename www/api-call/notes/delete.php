<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_note.php';
list($id, $note) = require_note($mysqli, $id_users);

include_once '../../fns/Notes/delete.php';
Notes\delete($mysqli, $id);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $id_users, -1);

header('Content-Type: application/json');
echo 'true';
