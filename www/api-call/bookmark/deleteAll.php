<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('bookmark/deleteAll',
    'can_write_bookmarks', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Bookmarks/deleteAll.php';
Users\Bookmarks\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
