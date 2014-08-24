<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user->id_users);

include_once '../../../fns/Users/Files/Received/delete.php';
Users\Files\Received\delete($mysqli, $receivedFile);

header('Content-Type: application/json');
echo 'true';
