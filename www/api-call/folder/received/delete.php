<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $user->id_users);

include_once '../../../fns/Users/Folders/Received/delete.php';
Users\Folders\Received\delete($mysqli, $receivedFolder);

header('Content-Type: application/json');
echo 'true';
