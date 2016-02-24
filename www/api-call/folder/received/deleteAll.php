<?php

include_once '../../fns/require_api_key.php';
require_api_key('folder/received/deleteAll',
    'can_write_files', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Folders/Received/deleteAll.php';
Users\Folders\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
