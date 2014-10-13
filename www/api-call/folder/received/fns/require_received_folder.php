<?php

function require_received_folder ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFolders/Committed/getOnReceiver.php";
    $receivedFolder = ReceivedFolders\Committed\getOnReceiver(
        $mysqli, $id_users, $id);

    if (!$receivedFolder) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_FOLDER_NOT_FOUND');
    }

    return $receivedFolder;

}
