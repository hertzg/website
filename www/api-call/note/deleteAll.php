<?php

include_once '../fns/require_api_key.php';
require_api_key('note/deleteAll', 'can_write_notes', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Notes/deleteAll.php';
Users\Notes\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
