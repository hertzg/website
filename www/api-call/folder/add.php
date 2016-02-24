<?php

include_once '../fns/require_api_key.php';
require_api_key('folder/add', 'can_write_files', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once 'fns/require_folder_params.php';
require_folder_params($mysqli, $id_users, $parent_id, $name);

include_once '../../fns/Users/Folders/add.php';
$id = Users\Folders\add($mysqli, $id_users, $parent_id, $name, $apiKey);

header('Content-Type: application/json');
echo $id;
