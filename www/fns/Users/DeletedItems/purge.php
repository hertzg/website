<?php

namespace Users\DeletedItems;

function purge ($mysqli, $deletedItem) {

    $type = $deletedItem->data_type;
    if ($type == 'file') {
        include_once __DIR__.'/purgeFile.php';
        purgeFile($deletedItem);
    } elseif ($type == 'receivedFile') {
        include_once __DIR__.'/purgeReceivedFile.php';
        purgeReceivedFile($deletedItem);
    }

    include_once __DIR__.'/delete.php';
    delete($mysqli, $deletedItem);

}
