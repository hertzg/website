<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $id_users);
$id_folders = $folder->id_folders;

include_once 'fns/request_folder_params.php';
$name = request_folder_params($mysqli, $id_users,
    $id_folders, $folder->parent_id_folders);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $id_users, $id_folders, $name);

header('Content-Type: application/json');
echo 'true';
