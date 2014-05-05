<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_note.php';
list($id, $note) = require_note($mysqli, $id_users);

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params();

include_once '../../fns/Users/Notes/edit.php';
Users\Notes\edit($mysqli, $id_users, $id, $text, $tags, $tag_names);

header('Content-Type: application/json');
echo 'true';
