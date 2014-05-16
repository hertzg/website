<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_file.php';
$file = require_file($mysqli, $id_users);

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once 'fns/request_file_params.php';
$name = request_file_params($mysqli, $id_users, $parent_id);

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $id_users, $file->id_files, $name);

header('Content-Type: application/json');
echo 'true';
