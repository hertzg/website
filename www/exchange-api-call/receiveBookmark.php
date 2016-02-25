<?php

include_once '../../lib/defaults.php';

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveBookmark', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_bookmark',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_bookmark_params.php';
require_bookmark_params($url, $title, $tags, $tag_names);

include_once '../fns/Users/Bookmarks/Received/add.php';
Users\Bookmarks\Received\add($mysqli, null, $sender_username,
    $receiver_user->id_users, $url, $title, $tags, $sender_address);

header('Content-Type: application/json');
echo 'true';
