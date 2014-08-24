<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bookmarks');

include_once 'fns/require_received_bookmark.php';
$receivedBookmark = require_received_bookmark($mysqli, $user->id_users);

include_once '../../../fns/Users/Bookmarks/Received/importCopy.php';
$id = Users\Bookmarks\Received\importCopy($mysqli, $receivedBookmark);

header('Content-Type: application/json');
echo $id;
