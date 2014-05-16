<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once 'fns/request_file_params.php';
$name = request_file_params($mysqli, $id_users, $parent_id);

$sourcePath = '/tmp/test_'.rand();
file_put_contents($sourcePath, 'test');

include_once '../../fns/Users/Files/add.php';
$id = Users\Files\add($mysqli, $id_users, $parent_id, $name, $sourcePath);

header('Content-Type: application/json');
echo $id;
