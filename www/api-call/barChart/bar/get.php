<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_bar_charts');

include_once 'fns/require_bar.php';
$bar = require_bar($mysqli, $user->id_users);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($bar));
