<?php

namespace Users\DeletedItems;

function delete ($mysqli, $deletedItem) {

    if ($deletedItem->data_type == 'receivedFile') {
        include_once __DIR__.'/deleteReceivedFile.php';
        deleteReceivedFile($deletedItem);
    }

    include_once __DIR__.'/../../DeletedItems/delete.php';
    \DeletedItems\delete($mysqli, $deletedItem->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $deletedItem->id_users, -1);

}
