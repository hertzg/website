<?php

namespace Users\Account\Close;

function deleteFolders ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_folders) {
        include_once "$fnsDir/Folders/deleteOnUser.php";
        \Folders\deleteOnUser($mysqli, $id_users);
    }

    if ($user->num_received_folders) {

        include_once "$fnsDir/ReceivedFolders/deleteOnReceiver.php";
        \ReceivedFolders\deleteOnReceiver($mysqli, $id_users);

        include_once "$fnsDir/ReceivedFolderFiles/deleteOnUser.php";
        \ReceivedFolderFiles\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/ReceivedFolderFiles/File/deleteOnUser.php";
        \ReceivedFolderFiles\File\deleteOnUser($id_users);

        include_once "$fnsDir/ReceivedFolderSubfolders/deleteOnUser.php";
        \ReceivedFolderSubfolders\deleteOnUser($mysqli, $id_users);

    }

}
