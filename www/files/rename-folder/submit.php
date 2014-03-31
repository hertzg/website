<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($folder_name) = request_strings('folder_name');

$errors = [];

include_once '../../fns/str_collapse_spaces.php';
$folder_name = str_collapse_spaces($folder_name);

if ($folder_name === '') {
    $errors[] = 'Enter folder name.';
} else {

    include_once '../../fns/Folders/getByName.php';
    $existingFolder = Folders\getByName($mysqli, $id_users,
        $folder->parent_id_folders, $folder_name, $id_folders);

    if ($existingFolder) {
        $errors[] = 'Folder with this name already exists.';
    }

}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-folder/errors'] = $errors;
    $_SESSION['files/rename-folder/values'] = [
        'folder_name' => $folder_name,
    ];
    redirect("./?id_folders=$id_folders");
}

unset(
    $_SESSION['files/rename-folder/errors'],
    $_SESSION['files/rename-folder/values']
);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $id_users, $id_folders, $folder_name);

$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['Renamed.'];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($id_folders, '../'));
