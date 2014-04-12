<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);
$id_users = $user->id_users;

$id_folders = 0;

include_once '../../../fns/Files/filename.php';
$filename = Files\filename($receivedFile->sender_id_users,
    $receivedFile->id_files);

include_once '../../../fns/Files/add.php';
Files\add($mysqli, $id_users, $id_folders, $receivedFile->file_name, $filename);

//include_once '../../../fns/ReceivedFiles/delete.php';
//ReceivedFiles\delete($mysqli, $id);

//include_once '../../../fns/Users/addNumReceivedFiles.php';
//Users\addNumReceivedFiles($mysqli, $id_users, -1);

$messages = ['File has been imported.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_files == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../..');
}

$_SESSION['files/received/messages'] = $messages;

redirect('..');
