<?php

include_once '../fns/require_api_key.php';
require_api_key('file/sendExisting',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_file');

include_once '../../fns/Users/Files/send.php';
Users\Files\send($mysqli, $user, $receiver_user->id_users, $file);

header('Content-Type: application/json');
echo 'true';
