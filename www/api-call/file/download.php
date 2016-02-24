<?php

include_once '../fns/require_api_key.php';
require_api_key('file/download', 'can_read_files', $apiKey, $user, $mysqli);

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user);

include_once '../../fns/Files/File/path.php';
$filePath = Files\File\path($user->id_users, $file->id_files);

header('Content-Type: application/octet-stream');
readfile($filePath);
