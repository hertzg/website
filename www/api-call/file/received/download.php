<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_file.php';
$receivedFile = require_received_file($mysqli, $user->id_users);

include_once '../../../fns/ReceivedFiles/filePath.php';
$filePath = ReceivedFiles\filePath($user->id_users, $receivedFile->id);

header('Content-Type: application/octet-stream');
readfile($filePath);
