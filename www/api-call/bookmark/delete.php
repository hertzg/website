<?php

include_once '../fns/require_api_key.php';
require_api_key('bookmark/delete',
    'can_write_bookmarks', $apiKey, $user, $mysqli);

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user);

include_once '../../fns/Users/Bookmarks/delete.php';
Users\Bookmarks\delete($mysqli, $bookmark, $apiKey);

header('Content-Type: application/json');
echo 'true';
