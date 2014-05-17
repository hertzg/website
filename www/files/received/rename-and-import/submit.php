<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($name) = request_strings('name');

include_once '../../../fns/str_collapse_spaces.php';
$name = str_collapse_spaces($name);

$id_folders = 0;
$errors = [];

if ($name === '') $errors[] = 'Enter file name.';

if (!$errors) {
    include_once '../../../fns/Files/getByName.php';
    $existingFile = Files\getByName($mysqli,
        $id_users, $id_folders, $name);
    if ($existingFile) {
        $errors[] = 'A file with the same name already exists.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/received/rename-and-import/errors'] = $errors;
    $_SESSION['files/received/rename-and-import/values'] = [
        'name' => $name,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/received/rename-and-import/errors'],
    $_SESSION['files/received/rename-and-import/values']
);

include_once '../../../fns/ReceivedFiles/filePath.php';
$receivedFilePath = ReceivedFiles\filePath($id_users, $id);

include_once '../../../fns/Users/Files/add.php';
Users\Files\add($mysqli, $id_users, $id_folders, $name, $receivedFilePath);

include_once '../../../fns/Users/Files/Received/delete.php';
Users\Files\Received\delete($mysqli, $id_users, $id);

$messages = ['File has been imported.'];

if ($user->num_received_files == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../..');
}

$_SESSION['files/received/messages'] = $messages;

redirect('..');
