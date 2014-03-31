<?php

function is_child_folder ($mysqli, $id_users, $folder, $id_folders) {
    while (true) {
        if ($folder->id_folders == $id_folders) return true;
        if (!$folder->parent_id_folders) return false;
        $folder = Folders\get($mysqli, $id_users, $folder->parent_id_folders);
    }
}

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($parent_id_folders) = request_strings('parent_id_folders');

include_once '../../fns/redirect.php';

$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $parent_id_folders);

    if (!$parentFolder) redirect("./?id_folders=$id_folders");

    if (is_child_folder($mysqli, $id_users, $parentFolder, $folder->id_folders)) {
        redirect("./?id_folders=$id_folders");
    }

}

include_once '../../fns/Folders/getByName.php';
$existingFolder = Folders\getByName($mysqli, $id_users, $parent_id_folders,
    $folder->folder_name);

if ($existingFolder) {
    $_SESSION['files/move-folder/parent_id_folders'] = $parent_id_folders;
    $_SESSION['files/move-folder/errors'] = [
        'A folder with the same name already exists in this folder.',
    ];
    redirect("./?id_folders=$id_folders&parent_id_folders=$parent_id_folders");
}

unset(
    $_SESSION['files/move-folder/parent_id_folders'],
    $_SESSION['files/move-folder/errors']
);

include_once '../../fns/Folders/move.php';
Folders\move($mysqli, $id_users, $id_folders, $parent_id_folders);

$_SESSION['files/id_folders'] = $parent_id_folders;
$_SESSION['files/messages'] = ['File has been moved.'];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($parent_id_folders, '../'));
