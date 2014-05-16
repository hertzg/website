<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_file.php';
$file = require_file($mysqli, $user->id_users);

include_once '../../fns/Users/Files/delete.php';
Users\Files\delete($mysqli, $file);

header('Content-Type: application/json');
echo 'true';
