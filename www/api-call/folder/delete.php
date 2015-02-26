<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);

include_once '../../fns/Users/Folders/delete.php';
Users\Folders\delete($mysqli, $folder, $apiKey);

header('Content-Type: application/json');
echo 'true';
