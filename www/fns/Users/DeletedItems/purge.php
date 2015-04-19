<?php

namespace Users\DeletedItems;

function purge ($mysqli, $deletedItem) {

    $type = $deletedItem->data_type;
    if ($type == 'contact' || $type == 'receivedContact') {
        include_once __DIR__.'/purgeContact.php';
        purgeContact($mysqli, $deletedItem);
    } elseif ($type == 'file') {
        include_once __DIR__.'/purgeFile.php';
        purgeFile($deletedItem);
    } elseif ($type == 'folder') {
        include_once __DIR__.'/purgeFolder.php';
        purgeFolder($mysqli, $deletedItem);
    } elseif ($type == 'place') {
        include_once __DIR__.'/purgePlace.php';
        purgePlace($mysqli, $deletedItem);
    } elseif ($type == 'receivedFile') {
        include_once __DIR__.'/purgeReceivedFile.php';
        purgeReceivedFile($deletedItem);
    } elseif ($type == 'receivedFolder') {
        include_once __DIR__.'/purgeReceivedFolder.php';
        purgeReceivedFolder($mysqli, $deletedItem);
    }

    include_once __DIR__.'/delete.php';
    delete($mysqli, $deletedItem);

}
