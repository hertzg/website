<?php

include_once '../../fns/require_api_key.php';
require_api_key('folder/received/importCopy',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $user);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once '../../../fns/Users/Folders/Received/importCopy.php';
$id = Users\Folders\Received\importCopy(
    $mysqli, $receivedFolder, $parent_id, $apiKey);

header('Content-Type: application/json');
echo $id;
