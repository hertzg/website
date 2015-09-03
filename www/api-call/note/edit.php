<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once 'fns/require_note.php';
$note = require_note($mysqli, $user);

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect, $encryption_key) = request_note_params();

include_once '../../fns/Users/Notes/edit.php';
Users\Notes\edit($mysqli, $note, $text, $tags, $tag_names,
    $encrypt_in_listings, $password_protect, $encryption_key, $apiKey);

header('Content-Type: application/json');
echo 'true';
