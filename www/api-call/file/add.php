<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');
$id_users = $user->id_users;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once 'fns/request_file_params.php';
$name = request_file_params($mysqli, $id_users, $parent_id);

include_once '../fns/require_file_param.php';
$file = require_file_param();

include_once '../../fns/Users/Files/add.php';
$id = Users\Files\add($mysqli, $id_users,
    $parent_id, $name, $file['tmp_name'], $apiKey);

header('Content-Type: application/json');
echo $id;
