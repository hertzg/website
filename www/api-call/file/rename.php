<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('file/rename', 'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user);
$id = $file->id_files;

include_once '../fns/require_parent_folder.php';
list($folder, $parent_id) = require_parent_folder($mysqli, $user);

include_once 'fns/require_file_params.php';
require_file_params($mysqli, $user->id_users, $parent_id, $name, $id);

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $id, $name, $apiKey);

header('Content-Type: application/json');
echo 'true';
