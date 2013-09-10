<?php

include_once 'lib/require-file.php';
include_once '../classes/Files.php';

session_commit();

header('Content-Disposition: attachment; filename="'.addslashes($file->filename).'"');
header('Content-Type: application/x-octet-stream');
header('Content-Length: '.$file->filesize);

readfile(Files::filename($idusers, $id));
