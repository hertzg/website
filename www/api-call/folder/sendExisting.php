<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_file');

include_once '../../fns/Users/Folders/send.php';
Users\Folders\send($mysqli, $user, $receiver_user->id_users, $folder);

header('Content-Type: application/json');
echo 'true';
