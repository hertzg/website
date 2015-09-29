<?php

function require_received_folder ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Folders/Received/get.php";
    $receivedFolder = Users\Folders\Received\get($mysqli, $user, $id);

    if (!$receivedFolder) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"RECEIVED_FOLDER_NOT_FOUND"');
    }

    return $receivedFolder;

}
