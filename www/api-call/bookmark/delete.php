<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bookmarks');

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user->id_users);

include_once '../../fns/Users/Bookmarks/delete.php';
Users\Bookmarks\delete($mysqli, $bookmark);

header('Content-Type: application/json');
echo 'true';
