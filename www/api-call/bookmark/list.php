<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_bookmarks');

include_once '../../fns/Users/Bookmarks/index.php';
$bookmarks = Users\Bookmarks\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $bookmarks));
