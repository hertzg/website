<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bookmarks');

include_once '../../fns/Users/Bookmarks/deleteAll.php';
Users\Bookmarks\deleteAll($mysqli, $user->id_users);

header('Content-Type: application/json');
echo 'true';
