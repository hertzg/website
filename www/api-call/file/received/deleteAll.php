<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once '../../../fns/Users/Files/Received/deleteAll.php';
Users\Files\Received\deleteAll($mysqli, $user->id_users, $apiKey);

header('Content-Type: application/json');
echo 'true';
