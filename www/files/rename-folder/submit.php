<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

include_once '../../fns/Folders/request.php';
$name = Folders\request();

$errors = [];

if ($name === '') {
    $errors[] = 'Enter folder name.';
} else {

    include_once '../../fns/Folders/getByName.php';
    $existingFolder = Folders\getByName($mysqli, $user->id_users,
        $folder->parent_id, $name, $id_folders);

    if ($existingFolder) {
        $errors[] = 'A folder with this name already exists.';
    }

}

$values = ['name' => $name];
$_SESSION['files/rename-folder/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-folder/errors'] = $errors;
    redirect("./?id_folders=$id_folders");
}

unset($_SESSION['files/rename-folder/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['files/rename-folder/send/errors'],
        $_SESSION['files/rename-folder/send/messages'],
        $_SESSION['files/rename-folder/send/values']
    );
    $_SESSION['files/rename-folder/send/folder'] = $values;
    redirect("send/?id_folders=$id_folders");
}

unset($_SESSION['files/rename-folder/values']);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $id_folders, $name, null);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['Folder has been renamed.'];

redirect("../?id_folders=$id_folders");
