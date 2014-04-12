<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

session_commit();

header('Content-Disposition: attachment; filename="'.addslashes($receivedFile->file_name).'"');
header('Content-Type: application/x-octet-stream');
header("Content-Length: $receivedFile->file_size");

include_once '../../../fns/Files/filename.php';
$filename = Files\filename($receivedFile->sender_id_users, $receivedFile->id_files);

readfile($filename);
