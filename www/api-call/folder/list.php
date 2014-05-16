<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/require_folder.php';
list($folder, $id_folders) = require_folder($mysqli, $id_users);

include_once '../../fns/Folders/indexInUserFolder.php';
$folders = Folders\indexInUserFolder($mysqli, $id_users, $id_folders);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $folders));
