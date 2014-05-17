<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user->id_users);

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_bookmark');

include_once '../../fns/Users/Bookmarks/send.php';
Users\Bookmarks\send($mysqli, $user, $receiver_user->id_users, $bookmark);

header('Content-Type: application/json');
echo 'true';
