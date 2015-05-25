<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notifications');

include_once 'fns/require_notification.php';
$notification = require_notification($mysqli, $user);

include_once '../../fns/Users/Notifications/delete.php';
Users\Notifications\delete($mysqli, $notification);

header('Content-Type: application/json');
echo 'true';
