<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once '../../../fns/Users/Folders/Received/deleteAll.php';
Users\Folders\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
