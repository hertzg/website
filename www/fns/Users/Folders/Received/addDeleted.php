<?php

namespace Users\Folders\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $id = $data->id;
    $archived = $data->archived;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolders/addDeleted.php";
    \ReceivedFolders\addDeleted($mysqli, $id, $data->sender_address,
        $data->sender_id_users, $data->sender_username, $receiver_id_users,
        $data->name, $archived, $data->insert_time);

    include_once "$fnsDir/ReceivedFolderFiles/setDeletedOnFolder.php";
    \ReceivedFolderFiles\setDeletedOnFolder($mysqli, $id, false);

    include_once "$fnsDir/ReceivedFolderSubfolders/setDeletedOnFolder.php";
    \ReceivedFolderSubfolders\setDeletedOnFolder($mysqli, $id, false);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receiver_id_users, 1, $archived ? 1 : 0);

}
