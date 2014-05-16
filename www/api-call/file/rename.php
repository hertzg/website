<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_file.php';
$file = require_file($mysqli, $id_users);

include_once 'fns/request_file_params.php';
$name = request_file_params();

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $id_users, $file->id_files, $name);

header('Content-Type: application/json');
echo 'true';
