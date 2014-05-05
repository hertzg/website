<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_bookmark.php';
list($id, $bookmark) = require_bookmark($mysqli, $id_users);

include_once '../../fns/Users/Bookmarks/delete.php';
Users\Bookmarks\delete($mysqli, $id, $id_users);

header('Content-Type: application/json');
echo 'true';
