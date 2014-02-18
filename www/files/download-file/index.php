<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id) = require_file($mysqli);

session_commit();

header('Content-Disposition: attachment; filename="'.addslashes($file->filename).'"');
header('Content-Type: application/x-octet-stream');
header('Content-Length: '.$file->filesize);

include_once '../fns/Files/filename.php';
$filename = Files\filename($idusers, $id);

readfile($filename);
