<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);
$id_folders = $folder->id_folders;

include_once 'fns/request_folder_params.php';
$name = request_folder_params($mysqli, $user->id_users,
    $folder->parent_id_folders, $id_folders);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $id_folders, $name, $apiKey);

header('Content-Type: application/json');
echo 'true';
