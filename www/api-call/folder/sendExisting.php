<?php

include_once '../fns/require_api_key.php';
require_api_key('folder/sendExisting',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_file');

include_once '../../fns/Users/Folders/send.php';
Users\Folders\send($mysqli, $user, $receiver_user->id_users, $folder);

header('Content-Type: application/json');
echo 'true';
