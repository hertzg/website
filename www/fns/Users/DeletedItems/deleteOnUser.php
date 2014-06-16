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

    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);

}
