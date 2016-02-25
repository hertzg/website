<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('notification/get',
    'can_read_notifications', $apiKey, $user, $mysqli);

include_once 'fns/require_notification.php';
$notification = require_notification($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($notification));
