<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_write_files', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Files/Received/deleteAll.php';
Users\Files\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
