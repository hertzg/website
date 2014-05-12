<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_bookmark.php';
$receivedBookmark = require_received_bookmark($mysqli, $user->id_users);

include_once '../../../fns/Users/Bookmarks/Received/delete.php';
Users\Bookmarks\Received\delete($mysqli, $receivedBookmark);

header('Content-Type: application/json');
echo 'true';
