<?php

include_once '../fns/require_api_key.php';
require_api_key('folder/delete', 'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_folder.php';
$folder = require_folder($mysqli, $user);

include_once '../../fns/Users/Folders/delete.php';
Users\Folders\delete($mysqli, $user, $folder, $apiKey);

header('Content-Type: application/json');
echo 'true';
