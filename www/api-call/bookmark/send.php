<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_bookmark');

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Users/Bookmarks/Received/add.php';
Users\Bookmarks\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $url, $title, $tags);

header('Content-Type: application/json');
echo 'true';
