<?php

namespace Users\DeletedItems;

function deleteOnUser ($mysqli, $id_users) {

    include_once __DIR__.'/../../DeletedItems/indexReceivedFilesOnUser.php';
    $deletedItems = \DeletedItems\indexReceivedFilesOnUser($mysqli, $id_users);
    if ($deletedItems) {
        include_once __DIR__.'/deleteReceivedFile.php';
        foreach ($deletedItems as $deletedItem) {
            deleteReceivedFile($deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/indexFilesOnUser.php';
    $deletedItems = \DeletedItems\indexFilesOnUser($mysqli, $id_users);
    if ($deletedItems) {
        include_once __DIR__.'/deleteFile.php';
        foreach ($deletedItems as $deletedItem) {
            deleteFile($deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_deleted_items = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
