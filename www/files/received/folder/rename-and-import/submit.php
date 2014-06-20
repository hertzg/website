<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

include_once "$fnsDir/request_strings.php";
list($name) = request_strings('name');

include_once "$fnsDir/str_collapse_spaces.php";
$name = str_collapse_spaces($name);

$errors = [];

$parent_id_folders = 0;

if ($name === '') $errors[] = 'Enter folder name.';
else {
    include_once "$fnsDir/Folders/getByName.php";
    $existingFolder = Folders\getByName($mysqli,
        $user->id_users, $parent_id_folders, $name);
    if ($existingFolder) $errors[] = 'A folder with this name already exists.';
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['files/received/folder/rename-and-import/errors'] = $errors;
    $_SESSION['files/received/folder/rename-and-import/values'] = [
        'name' => $name,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/received/folder/rename-and-import/errors'],
    $_SESSION['files/received/folder/rename-and-import/values']
);

$messages = ['Folder has been imported.'];

if (!$user->num_received_files && $user->num_received_folders == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../../..');
}

$_SESSION['files/received/messages'] = $messages;

redirect('../..');
