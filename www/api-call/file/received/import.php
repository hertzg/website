<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user->id_users);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once '../../../fns/Users/Files/Received/import.php';
$id = Users\Files\Received\import($mysqli, $receivedFile, $parent_id, $apiKey);

header('Content-Type: application/json');
echo $id;
