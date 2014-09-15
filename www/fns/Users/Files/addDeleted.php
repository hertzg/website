<?php

namespace Users\Files;

function addDeleted ($mysqli, $id_users, $data) {

    $id_folders = $data->id_folders;
    $size = $data->size;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Folders/get.php";
    $folder = \Folders\get($mysqli, $id_users, $id_folders);
    if (!$folder) $id_folders = 0;

    include_once "$fnsDir/Files/addDeleted.php";
    \Files\addDeleted($mysqli, $data->id, $id_users,
        $id_folders, $data->content_type, $data->media_type, $data->name,
        $size, $data->insert_time, $data->rename_time);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

}
