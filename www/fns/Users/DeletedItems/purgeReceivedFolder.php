<?php

namespace Users\DeletedItems;

function purgeReceivedFolder ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);
    $id = $data->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ReceivedFolderSubfolders/deleteOnReceivedFolder.php";
    \ReceivedFolderSubfolders\deleteOnReceivedFolder($mysqli, $id);

    include_once "$fnsDir/Users/Folders/Received/Files/deleteAll.php";
    \Users\Folders\Received\Files\deleteAll($mysqli, $id);

}
