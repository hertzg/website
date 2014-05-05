<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params();

include_once '../../fns/Users/Notes/add.php';
$id = Users\Notes\add($mysqli, $id_users, $text, $tags, $tag_names);

header('Content-Type: application/json');
echo $id;
