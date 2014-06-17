<?php

namespace Users\Files;

function addDeleted ($mysqli, $id_users, $data) {

    $size = $data->size;

    include_once __DIR__.'/../../Files/addDeleted.php';
    \Files\addDeleted($mysqli, $data->id, $id_users, $data->id_folders,
        $data->name, $size, $data->insert_time, $data->rename_time);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

}
