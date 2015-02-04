<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_file');

include_once '../../fns/Files/request.php';
$name = Files\request();

include_once '../fns/require_file_param.php';
$file = require_file_param();

include_once '../../fns/Users/Files/Received/add.php';
Users\Files\Received\add($mysqli, $user, $receiver_user->id_users,
    $name, $file['size'], $file['tmp_name']);

header('Content-Type: application/json');
echo 'true';
