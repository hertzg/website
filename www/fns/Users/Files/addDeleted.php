<?php

namespace Users\Files;

function addDeleted ($mysqli, $user, $data) {

    $id_folders = $data->id_folders;
    $id_users = $user->id_users;
    $name = $data->name;
    $size = $data->size;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Users/Folders/get.php";
    $folder = \Users\Folders\get($mysqli, $user, $id_folders);
    if (!$folder) $id_folders = 0;

    include_once "$fnsDir/Files/getUniqueName.php";
    $name = \Files\getUniqueName($mysqli, $id_users, $id_folders, $name);

    include_once "$fnsDir/Files/addDeleted.php";
    \Files\addDeleted($mysqli, $data->id, $id_users,
        $id_folders, $data->content_type, $data->media_type, $name,
        $size, $data->insert_time, $data->rename_time,
        $data->content_revision, $data->revision);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

}
