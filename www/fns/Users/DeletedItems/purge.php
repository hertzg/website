<?php

namespace Users\DeletedItems;

function purge ($mysqli, $deletedItem) {

    $type = $deletedItem->data_type;
    if ($type == 'barChart') {
        include_once __DIR__.'/purgeBarChart.php';
        purgeBarChart($mysqli, $deletedItem);
    } elseif ($type == 'bookmark') {
        include_once __DIR__.'/purgeBookmark.php';
        purgeBookmark($mysqli, $deletedItem);
    } elseif ($type == 'calculation') {
        include_once __DIR__.'/purgeCalculation.php';
        purgeCalculation($mysqli, $deletedItem);
    } elseif ($type == 'contact' || $type == 'receivedContact') {
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
    } elseif ($type == 'task') {
        include_once __DIR__.'/purgeTask.php';
        purgeTask($mysqli, $deletedItem);
    } elseif ($type == 'wallet') {
        include_once __DIR__.'/purgeWallet.php';
        purgeWallet($mysqli, $deletedItem);
    }

    include_once __DIR__.'/delete.php';
    delete($mysqli, $deletedItem);

}
