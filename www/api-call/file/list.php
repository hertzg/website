<?php

include_once '../fns/require_api_key.php';
require_api_key('file/list', 'can_read_files', $apiKey, $user, $mysqli);

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once '../../fns/Users/Files/index.php';
$files = Users\Files\index($mysqli, $user, $parent_id);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map(function ($file) use ($mysqli) {
    return to_client_json($mysqli, $file);
}, $files));
