<?php

include_once '../../fns/require_api_key.php';
require_api_key('file/received/download',
    'can_read_files', $apiKey, $user, $mysqli);

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user);

include_once '../../../fns/ReceivedFiles/File/path.php';
$filePath = ReceivedFiles\File\path($user->id_users, $receivedFile->id);

header('Content-Type: application/octet-stream');
readfile($filePath);
