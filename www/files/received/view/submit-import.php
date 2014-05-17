<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);
$id_users = $user->id_users;

$id_folders = 0;

include_once '../../../fns/ReceivedFiles/filePath.php';
$receivedFilePath = ReceivedFiles\filePath($id_users, $id);

$name = $receivedFile->name;

include_once '../../../fns/Files/getByName.php';
while (Files\getByName($mysqli, $id_users, $id_folders, $name)) {
    $extension = '';
    if (preg_match('/\..*?$/', $name, $match)) {
        $name = preg_replace('/\..*?$/', '', $name);
        $extension = $match[0];
    }
    if (preg_match('/_(\d+)$/', $name, $match)) {
        $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
    } else {
        $name .= '_1';
    }
    if ($extension) {
        $name = "$name$extension";
    }
}

include_once '../../../fns/Users/Files/add.php';
Users\Files\add($mysqli, $id_users, $id_folders, $name, $receivedFilePath);

include_once '../../../fns/Users/Files/Received/delete.php';
Users\Files\Received\delete($mysqli, $id_users, $id);

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
