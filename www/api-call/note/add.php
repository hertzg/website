<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_notes', $apiKey, $user, $mysqli);

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect, $encryption_key) = request_note_params();

include_once '../../fns/Users/Notes/add.php';
$id = Users\Notes\add($mysqli, $user->id_users, $text, $tags, $tag_names,
    $encrypt_in_listings, $password_protect, $encryption_key, $apiKey);

header('Content-Type: application/json');
echo $id;
