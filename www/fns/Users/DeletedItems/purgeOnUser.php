<?php

namespace Users\DeletedItems;

function purgeOnUser ($mysqli, $id_users) {

    include_once __DIR__.'/../../DeletedItems/indexFilesOnUser.php';
    $deletedItems = \DeletedItems\indexFilesOnUser($mysqli, $id_users);
    if ($deletedItems) {
        include_once __DIR__.'/purgeFile.php';
        foreach ($deletedItems as $deletedItem) {
            purgeFile($deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/indexReceivedFilesOnUser.php';
    $deletedItems = \DeletedItems\indexReceivedFilesOnUser($mysqli, $id_users);
    if ($deletedItems) {
        include_once __DIR__.'/purgeReceivedFile.php';
        foreach ($deletedItems as $deletedItem) {
            purgeReceivedFile($deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/indexReceivedFoldersOnUser.php';
    $deletedItems = \DeletedItems\indexReceivedFoldersOnUser($mysqli, $id_users);
    if ($deletedItems) {
        include_once __DIR__.'/purgeReceivedFolder.php';
        foreach ($deletedItems as $deletedItem) {
            purgeReceivedFolder($mysqli, $deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_deleted_items = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
