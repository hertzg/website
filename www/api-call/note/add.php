<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect) = request_note_params();

include_once '../../fns/Users/Notes/add.php';
$id = Users\Notes\add($mysqli, $user->id_users, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect, $apiKey);

header('Content-Type: application/json');
echo $id;
