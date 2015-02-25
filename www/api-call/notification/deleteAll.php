<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notifications');

include_once '../../fns/Users/Notifications/deleteAll.php';
Users\Notifications\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
