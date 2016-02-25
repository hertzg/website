<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('file/received/importCopy',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user);

include_once '../../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once '../../../fns/Users/Files/Received/importCopy.php';
$id = Users\Files\Received\importCopy(
    $mysqli, $receivedFile, $parent_id, $apiKey);

header('Content-Type: application/json');
echo $id;
