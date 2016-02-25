<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('notification/list',
    'can_read_notifications', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Notifications/index.php';
$notifications = Users\Notifications\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $notifications));
