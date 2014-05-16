<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $id_users);

include_once 'fns/request_file_params.php';
$name = request_file_params($mysqli, $id_users, $parent_id);

include_once '../../fns/request_files.php';
list($file) = request_files('file');

$error = $file['error'];
if ($error === UPLOAD_ERR_NO_FILE) {
    include_once '../fns/bad_request.php';
    bad_request('SELECT_FILE');
} elseif ($error !== UPLOAD_ERR_OK) {
    include_once '../fns/bad_request.php';
    bad_request('FILE_ERROR');
}

include_once '../../fns/Users/Files/add.php';
$id = Users\Files\add($mysqli, $id_users, $parent_id, $name, $file['tmp_name']);

header('Content-Type: application/json');
echo $id;
