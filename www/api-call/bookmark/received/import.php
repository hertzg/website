<?php

include_once '../../fns/require_api_key.php';
require_api_key('bookmark/received/import',
    'can_write_bookmarks', $apiKey, $user, $mysqli);

include_once 'fns/require_received_bookmark.php';
$receivedBookmark = require_received_bookmark($mysqli, $user);

include_once '../../../fns/Users/Bookmarks/Received/import.php';
$id = Users\Bookmarks\Received\import($mysqli, $receivedBookmark, $apiKey);

header('Content-Type: application/json');
echo $id;
