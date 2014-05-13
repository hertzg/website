<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../../fns/Users/Bookmarks/Received/deleteAll.php';
Users\Bookmarks\Received\deleteAll($mysqli, $user->id_users);

header('Content-Type: application/json');
echo 'true';
