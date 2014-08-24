<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');

include_once '../../../fns/Users/Notes/Received/deleteAll.php';
Users\Notes\Received\deleteAll($mysqli, $user->id_users);

header('Content-Type: application/json');
echo 'true';
