<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Users/Events/deleteAll.php';
Users\Events\deleteAll($mysqli, $user->id_users);

header('Content-Type: application/json');
echo 'true';
