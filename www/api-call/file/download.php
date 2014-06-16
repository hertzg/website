<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user->id_users);

include_once '../../fns/Files/File/path.php';
$filePath = Files\File\path($user->id_users, $file->id_files);

header('Content-Type: application/octet-stream');
readfile($filePath);
