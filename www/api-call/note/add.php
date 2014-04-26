<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params();

include_once '../../fns/Notes/add.php';
$id = Notes\add($mysqli, $id_users, $text, $tags);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $id_users, $id, $tag_names, $text);

header('Content-Type: application/json');
echo json_encode(['id' => $id]);
