<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('folder/received/delete',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_folder.php';
$receivedFolder = require_received_folder($mysqli, $user);

include_once '../../../fns/Users/Folders/Received/delete.php';
Users\Folders\Received\delete($mysqli, $receivedFolder, $apiKey);

header('Content-Type: application/json');
echo 'true';
