<?php

function require_received_folder_subfolder ($mysqli) {

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFolderSubfolders/getOnUser.php";
    $receivedFolderSubfolder = ReceivedFolderSubfolders\getOnUser(
        $mysqli, $user->id_users, $id);

    if (!$receivedFolderSubfolder || $receivedFolderSubfolder->deleted) {
        include_once "$fnsDir/redirect.php";
        redirect('../..');
    }

    return [$receivedFolderSubfolder, $id, $user];

}
