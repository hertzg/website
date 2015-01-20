<?php

function is_child_folder ($mysqli, $id_users, $folder, $id_folders) {
    while (true) {
        if ($folder->id_folders == $id_folders) return true;
        if (!$folder->parent_id_folders) return false;
        $folder = Folders\get($mysqli, $id_users, $folder->parent_id_folders);
    }
}

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);
$id_users = $user->id_users;

include_once "$fnsDir/request_strings.php";
list($parent_id_folders) = request_strings('parent_id_folders');

include_once "$fnsDir/redirect.php";

$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {

    include_once "$fnsDir/Folders/getOnUser.php";
    $parentFolder = Folders\getOnUser($mysqli, $id_users, $parent_id_folders);

    if (!$parentFolder) redirect("./?id_folders=$id_folders");

    $is_child_folder = is_child_folder($mysqli, $id_users,
        $parentFolder, $folder->id_folders);
    if ($is_child_folder) redirect("./?id_folders=$id_folders");

}

include_once "$fnsDir/Folders/getByName.php";
$existingFolder = Folders\getByName($mysqli,
    $id_users, $parent_id_folders, $folder->name);

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

include_once "$fnsDir/Folders/move.php";
Folders\move($mysqli, $id_folders, $parent_id_folders);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $parent_id_folders;
$_SESSION['files/messages'] = ['File has been moved.'];

include_once "$fnsDir/create_folder_link.php";
redirect(create_folder_link($parent_id_folders, '../'));
