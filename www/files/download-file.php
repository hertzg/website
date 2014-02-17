<?php

include_once 'lib/require-file.php';

session_commit();

header('Content-Disposition: attachment; filename="'.addslashes($file->filename).'"');
header('Content-Type: application/x-octet-stream');
header('Content-Length: '.$file->filesize);

include_once '../fns/Files/filename.php';
$filename = Files\filename($idusers, $id);

readfile($filename);
