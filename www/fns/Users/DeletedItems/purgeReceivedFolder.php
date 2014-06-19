<?php

namespace Users\DeletedItems;

function purgeReceivedFolder ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);
    $id = $data->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ReceivedFolderSubfolders/deleteOnReceivedFolder.php";
    \ReceivedFolderSubfolders\deleteOnReceivedFolder($mysqli, $id);

    include_once "$fnsDir/ReceivedFolderFiles/indexOnReceivedFolder.php";
    $files = \ReceivedFolderFiles\indexOnReceivedFolder($mysqli, $id);

    if ($files) {
        include_once "$fnsDir/ReceivedFolderFiles/File/delete.php";
        foreach ($files as $file) {
            \ReceivedFolderFiles\File\delete($file->id_users, $file->id);
        }
    }

    include_once "$fnsDir/ReceivedFolderFiles/deleteOnReceivedFolder.php";
    \ReceivedFolderFiles\deleteOnReceivedFolder($mysqli, $id);

}
