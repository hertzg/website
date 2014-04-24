<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_note.php';
list($id, $note) = require_note($mysqli, $id_users);

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params();

include_once '../../fns/Notes/edit.php';
Notes\edit($mysqli, $id_users, $id, $text, $tags);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $id_users, $id, $tag_names, $text);

header('Content-Type: application/json');
echo 'true';
