<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../../fns/Files/File/path.php';
$path = Files\File\path($user->id_users, $id);

include_once '../../fns/echo_file.php';
echo_file($file, $path);
