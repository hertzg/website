<?php

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

session_commit();

$fnsDir = '../../../../fns';

include_once "$fnsDir/request_strings.php";
list($contentType) = request_strings('contentType');

include_once "$fnsDir/str_collapse_spaces.php";
$contentType = str_collapse_spaces($contentType);

if ($contentType === '') $contentType = 'application/x-octet-stream';

$filename = addslashes($receivedFile->name);
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: $contentType");
header("Content-Length: $receivedFile->size");

include_once "$fnsDir/ReceivedFiles/File/path.php";
readfile(ReceivedFiles\File\path($user->id_users, $id));
