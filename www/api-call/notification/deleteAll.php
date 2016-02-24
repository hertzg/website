<?php

include_once '../fns/require_api_key.php';
require_api_key('notification/deleteAll',
    'can_write_notifications', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Notifications/deleteAll.php';
Users\Notifications\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
