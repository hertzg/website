<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $id_users);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once '../../../fns/Users/Files/Received/import.php';
$id = Users\Files\Received\import($mysqli, $receivedFile, $parent_id);

header('Content-Type: application/json');
echo $id;
