<?php

function delete_received_items ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ReceivedBookmarks/deleteOnReceiver.php";
    ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedContacts/deleteOnReceiver.php";
    ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedFiles/deleteOnReceiver.php";
    ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedFiles/File/deleteOnReceiver.php";
    ReceivedFiles\File\deleteOnReceiver($id_users);

    include_once "$fnsDir/ReceivedFolders/deleteOnReceiver.php";
    ReceivedFolders\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedFolderFiles/deleteOnUser.php";
    ReceivedFolderFiles\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ReceivedFolderFiles/File/deleteOnUser.php";
    ReceivedFolderFiles\File\deleteOnUser($id_users);

    include_once "$fnsDir/ReceivedFolderSubfolders/deleteOnUser.php";
    ReceivedFolderSubfolders\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ReceivedNotes/deleteOnReceiver.php";
    ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

    include_once "$fnsDir/ReceivedTasks/deleteOnReceiver.php";
    ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

}
