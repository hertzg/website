<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('file/received/delete',
    'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user);

include_once '../../../fns/Users/Files/Received/delete.php';
Users\Files\Received\delete($mysqli, $receivedFile, $apiKey);

header('Content-Type: application/json');
echo 'true';
