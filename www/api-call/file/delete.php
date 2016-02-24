<?php

include_once '../fns/require_api_key.php';
require_api_key('file/delete', 'can_write_files', $apiKey, $user, $mysqli);

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user);

include_once '../../fns/Users/Files/delete.php';
Users\Files\delete($mysqli, $file, $apiKey);

header('Content-Type: application/json');
echo 'true';
