<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user->id_users);

include_once '../../fns/Users/Folders/delete.php';
Users\Folders\delete($mysqli, $folder->id_folders);

header('Content-Type: application/json');
echo 'true';
