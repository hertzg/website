<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($file, $id, $user) = require_received_file($mysqli, '../');

include_once '../../../../fns/ReceivedFiles/File/path.php';
$path = ReceivedFiles\File\path($user->id_users, $id);

include_once '../../../../fns/echo_file.php';
echo_file($file, $path);
