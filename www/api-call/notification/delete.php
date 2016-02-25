<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('notification/delete',
    'can_write_notifications', $apiKey, $user, $mysqli);

include_once 'fns/require_notification.php';
$notification = require_notification($mysqli, $user);

include_once '../../fns/Users/Notifications/delete.php';
Users\Notifications\delete($mysqli, $notification);

header('Content-Type: application/json');
echo 'true';
