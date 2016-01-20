<?php

function is_child_folder ($mysqli, $id_users, $folder, $id_folders) {
    while (true) {
        if ($folder->id_folders == $id_folders) return true;
        $parent_id = $folder->parent_id;
        if (!$parent_id) return false;
        $folder = Folders\get($mysqli, $id_users, $parent_id);
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
list($parent_id) = request_strings('parent_id');

include_once "$fnsDir/redirect.php";

$parent_id = abs((int)$parent_id);
if ($parent_id) {

    include_once "$fnsDir/Users/Folders/get.php";
    $parentFolder = Users\Folders\get($mysqli, $user, $parent_id);

    if (!$parentFolder) redirect("./?id_folders=$id_folders");

    $is_child_folder = is_child_folder($mysqli, $id_users,
        $parentFolder, $folder->id_folders);
    if ($is_child_folder) redirect("./?id_folders=$id_folders");

}

include_once "$fnsDir/Folders/getByName.php";
$existingFolder = Folders\getByName($mysqli,
    $id_users, $parent_id, $folder->name);

if ($existingFolder) {
    $_SESSION['files/move-folder/parent_id'] = $parent_id;
    $_SESSION['files/move-folder/errors'] = [
        'A folder with the same name already exists in this folder.',
    ];
    redirect("./?id_folders=$id_folders&parent_id=$parent_id");
}

unset(
    $_SESSION['files/move-folder/parent_id'],
    $_SESSION['files/move-folder/errors']
);

include_once "$fnsDir/Folders/move.php";
Folders\move($mysqli, $id_folders, $parent_id);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $parent_id;
$_SESSION['files/messages'] = ['File has been moved.'];

include_once '../fns/create_parent_url.php';
redirect(create_parent_url($parent_id, '../'));
