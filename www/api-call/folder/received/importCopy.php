<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');
$id_users = $user->id_users;

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $id_users);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once '../../../fns/Users/Folders/Received/importCopy.php';
$id = Users\Folders\Received\importCopy($mysqli, $receivedFolder, $parent_id);

header('Content-Type: application/json');
echo $id;
