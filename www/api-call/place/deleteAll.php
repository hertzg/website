<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_places');

include_once '../../fns/Users/Places/deleteAll.php';
Users\Places\deleteAll($mysqli, $user->id_users, $apiKey);

header('Content-Type: application/json');
echo 'true';
