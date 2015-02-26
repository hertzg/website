<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $user);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once '../../../fns/Users/Folders/Received/import.php';
$id = Users\Folders\Received\import(
    $mysqli, $receivedFolder, $parent_id, $apiKey);

header('Content-Type: application/json');
echo $id;
