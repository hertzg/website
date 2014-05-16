<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once '../../fns/Files/indexInUserFolder.php';
$files = Files\indexInUserFolder($mysqli, $id_users, $parent_id);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $files));
