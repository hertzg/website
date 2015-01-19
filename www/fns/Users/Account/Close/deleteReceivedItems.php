<?php

namespace Users\Account\Close;

function deleteReceivedItems ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_received_bookmarks) {
        include_once "$fnsDir/ReceivedBookmarks/deleteOnReceiver.php";
        \ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);
    }

    if ($user->num_received_contacts) {
        include_once "$fnsDir/ReceivedContacts/deleteOnReceiver.php";
        \ReceivedContacts\deleteOnReceiver($mysqli, $id_users);
    }

    if ($user->num_received_files) {

        include_once "$fnsDir/ReceivedFiles/deleteOnReceiver.php";
        \ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

        include_once "$fnsDir/ReceivedFiles/File/deleteOnReceiver.php";
        \ReceivedFiles\File\deleteOnReceiver($id_users);

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

    if ($user->num_received_notes) {
        include_once "$fnsDir/ReceivedNotes/deleteOnReceiver.php";
        \ReceivedNotes\deleteOnReceiver($mysqli, $id_users);
    }

    if ($user->num_received_tasks) {
        include_once "$fnsDir/ReceivedTasks/deleteOnReceiver.php";
        \ReceivedTasks\deleteOnReceiver($mysqli, $id_users);
    }

}
