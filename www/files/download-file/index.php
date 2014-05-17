<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

session_commit();

include_once '../../fns/request_strings.php';
list($contentType) = request_strings('contentType');

include_once '../../fns/str_collapse_spaces.php';
$contentType = str_collapse_spaces($contentType);

if ($contentType === '') $contentType = 'application/x-octet-stream';

header('Content-Disposition: attachment; filename="'.addslashes($file->name).'"');
header("Content-Type: $contentType");
header("Content-Length: $file->size");

include_once '../../fns/Files/filePath.php';
readfile(Files\filePath($user->id_users, $id));
