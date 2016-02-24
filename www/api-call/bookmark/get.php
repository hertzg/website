<?php

include_once '../fns/require_api_key.php';
require_api_key('bookmark/get', 'can_read_bookmarks', $apiKey, $user, $mysqli);

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($bookmark));
