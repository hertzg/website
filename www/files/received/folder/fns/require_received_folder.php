<?php

function require_received_folder ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFolders/getOnReceiver.php";
    $receivedFolder = ReceivedFolders\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedFolder) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$receivedFolder, $id, $user];

}
