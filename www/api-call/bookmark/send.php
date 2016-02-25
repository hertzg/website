<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('bookmark/send',
    'can_write_bookmarks', $apiKey, $user, $mysqli);

$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_bookmark');

include_once 'fns/require_bookmark_params.php';
require_bookmark_params($url, $title, $tags, $tag_names);

include_once '../../fns/Users/Bookmarks/Received/add.php';
Users\Bookmarks\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $url, $title, $tags);

header('Content-Type: application/json');
echo 'true';
