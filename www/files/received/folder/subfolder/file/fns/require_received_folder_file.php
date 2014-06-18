<?php

function require_received_folder_file ($mysqli) {

    $fnsDir = __DIR__.'/../../../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFolderFiles/getOnUser.php";
    $receivedFolderFile = ReceivedFolderFiles\getOnUser(
        $mysqli, $user->id_users, $id);

    if (!$receivedFolderFile || !$receivedFolderFile->parent_id) {
        include_once "$fnsDir/redirect.php";
        redirect('../../../..');
    }

    return [$receivedFolderFile, $id, $user];

}
