<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('note/received/deleteAll',
    'can_write_notes', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Notes/Received/deleteAll.php';
Users\Notes\Received\deleteAll($mysqli, $user->id_users, $apiKey);

header('Content-Type: application/json');
echo 'true';
