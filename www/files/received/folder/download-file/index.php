<?php

include_once '../fns/require_received_folder_file.php';
include_once '../../../../lib/mysqli.php';
list($file, $id, $user) = require_received_folder_file($mysqli);

include_once '../../../../fns/ReceivedFolderFiles/File/path.php';
$path = ReceivedFolderFiles\File\path($user->id_users, $id);

include_once '../../../../fns/echo_file.php';
echo_file($file, $path);
