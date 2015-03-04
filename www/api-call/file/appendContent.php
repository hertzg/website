<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user);

include_once '../fns/require_file_param.php';
$file_param = require_file_param();

include_once '../../fns/Users/Files/appendContent.php';
Users\Files\appendContent($mysqli, $file, $file_param['tmp_name']);

header('Content-Type: application/json');
echo 'true';
